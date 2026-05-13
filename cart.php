<?php include_once('./includes/headerNav.php'); ?>
<div class="overlay" data-overlay></div>

<?php
require_once './includes/topheadactions.php';
require_once './includes/desktopnav.php';
require_once './includes/mobilenav.php';
?>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f9f9f9;
    color: #333;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    margin-left: 200px;
  }

  th, td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
  }

  th {
    background: #4d3e29;
    color: white;
    font-size: 16px;
  }

  tr:hover {
    background-color: #f1f1f1;
  }

  td img {
    width: 80px;
    border-radius: 8px;
  }

  .qty-form {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .qty-form button {
    background-color: #36454F;
    color: #fff;
    border: none;
    padding: 5px 12px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    margin: 0 5px;
    transition: background 0.3s ease;
  }

  .qty-form button:hover {
    background-color: #222;
  }

  .qty-form span {
    min-width: 30px;
    display: inline-block;
  }

  input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
  }

  .cart-total {
    font-size: 22px;
    font-weight: bold;
    margin-top: 25px;
    text-align: right;
    padding: 10px;
    color: #36454F;
  }

  .child-register-btn {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .child-register-btn p {
    background-color: #4d3e29;
    color: white;
    font-weight: bold;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  .child-register-btn p:hover {
    background-color: #4d3e29;
  }

  @media (max-width: 768px) {
    td, th {
      font-size: 14px;
      padding: 10px;
    }

    .cart-total {
      text-align: center;
    }

    .qty-form {
      flex-direction: column;
    }

    .qty-form button {
      margin: 3px 0;
    }
  }
</style>

<main>
  <div class="product-container">
    <div class="container">
      <form id="checkoutForm">
        <table border="1" width="100%" id="cartTable">
          <tr>
            <th><input type="checkbox" id="selectAll"></th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Remove</th>
          </tr>

          <?php
          include_once 'includes/config.php';
          $customer_id = $_SESSION['id'] ?? null;

          if ($customer_id) {
            $sql = "SELECT * FROM cart WHERE customer_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              while ($value = $result->fetch_assoc()) {
                $product_id = $value['product_id'];
                $subtotal = $value['product_qty'] * $value['product_price'];
                ?>
                <tr id="row_<?php echo $product_id; ?>">
                  <td><input type="checkbox" class="selectItem" data-id="<?php echo $product_id; ?>"></td>
                  <td><img src="./admin/upload/<?php echo $value['product_img']; ?>"></td>
                  <td><?php echo $value['product_name']; ?></td>
                  <td>₱<?php echo number_format($value['product_price'], 2); ?></td>
                  <td>
                    <div class="qty-form">
                      <button type="button" onclick="updateQty(<?php echo $product_id; ?>, 'decrease')">-</button>
                      <span id="qty_<?php echo $product_id; ?>"><?php echo $value['product_qty']; ?></span>
                      <button type="button" onclick="updateQty(<?php echo $product_id; ?>, 'increase')">+</button>
                    </div>
                  </td>
                  <td>₱<span id="subtotal_<?php echo $product_id; ?>"><?php echo number_format($subtotal, 2); ?></span></td>
                  <td><button type="button" onclick="removeItem(<?php echo $product_id; ?>)">🗑️</button></td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='7'>No item available in cart</td></tr>";
            }
          } else {
            echo "<tr><td colspan='7'>Please log in to view your cart.</td></tr>";
          }
          ?>
        </table>

        <div class="cart-total">Total: ₱<span id="totalAmount">0.00</span></div>

        <div class="child-register-btn">
          <p onclick="submitCheckout()">CHECKOUT</p>
        </div>
      </form>
    </div>
  </div>
</main>

<?php require_once './includes/footer.php'; ?>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function updateQty(product_id, action) {
    $.post('update_cart.php', { product_id: product_id, action: action }, function (response) {
      if (response.success) {
        $('#qty_' + product_id).text(response.new_qty);
        const price = parseFloat($('#row_' + product_id + ' td:nth-child(4)').text().replace('₱', ''));
        const newSubtotal = (price * response.new_qty).toFixed(2);
        $('#subtotal_' + product_id).text(newSubtotal);
        updateTotal();
      }
    }, 'json');
  }

  function removeItem(product_id) {
    if (confirm("Remove this item?")) {
      $.post('update_cart.php', { product_id: product_id, action: 'remove' }, function (response) {
        if (response.success) {
          $('#row_' + product_id).fadeOut(300, function () {
            $(this).remove();
            updateTotal();
          });
        }
      }, 'json');
    }
  }

  function updateTotal() {
    let total = 0;
    $('.selectItem:checked').each(function () {
      const id = $(this).data('id');
      const subtotal = parseFloat($('#subtotal_' + id).text());
      total += subtotal;
    });
    $('#totalAmount').text(total.toFixed(2));
  }

  $(document).on('change', '.selectItem', updateTotal);

  $('#selectAll').on('change', function () {
    $('.selectItem').prop('checked', $(this).prop('checked'));
    updateTotal();
  });

  function submitCheckout() {
  const selected = $('.selectItem:checked').map(function () {
    return $(this).data('id');
  }).get();

  if (selected.length === 0) {
    alert("Please select at least one item.");
    return;
  }

  const params = new URLSearchParams();
  selected.forEach(id => params.append("product_ids[]", id));

  window.location.href = 'checkout.php?' + params.toString();
}

</script>

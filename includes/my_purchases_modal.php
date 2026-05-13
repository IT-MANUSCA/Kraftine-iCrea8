<!-- Modal Container (My Purchases) -->
<div id="myPurchasesModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index:1000; justify-content:center; align-items:center;">
  <div style="background:white; width:90%; max-width:1000px; max-height:90vh; overflow-y:auto; padding:20px; border-radius:10px; position:relative;">
    <button onclick="closeMyPurchasesModal()" style="position:absolute; top:10px; right:15px; background:#e75480; color:white; border:none; padding:5px 10px; border-radius:5px;">Close</button>
    <div id="myPurchasesContent">Loading...</div>
  </div>
</div>

<script>
function openMyPurchasesModal() {
  const modal = document.getElementById('myPurchasesModal');
  const content = document.getElementById('myPurchasesContent');

  modal.style.display = 'flex';
  content.innerHTML = '<p>Loading purchases...</p>';

  fetch('./my_purchases_modal.php')
    .then(response => response.text())
    .then(data => {
      content.innerHTML = data;
    })
    .catch(err => {
      content.innerHTML = '<p>Error loading purchases.</p>';
    });
}

function closeMyPurchasesModal() {
  document.getElementById('myPurchasesModal').style.display = 'none';
}
</script>

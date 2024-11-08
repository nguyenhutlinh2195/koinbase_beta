get_info();

function set_info(event) {
  event.preventDefault();

  let form_data = new URLSearchParams();
  form_data.append("sender_id", event.target.elements.sender_id.value); // lấy giá trị của sender_id từ form
  form_data.append("receiver_id", event.target.elements.receiver_id.value);//lấy giá trị của receiver_id từ form
  form_data.append("amount", event.target.elements.amount.value);// lấy giá trị của amount từ form

  fetch("/api/transaction.php?action=transfer_money", {
    method: "POST",
    headers:{
      'Content-Type': 'application/x-www-form-urlencoded'
    }, 
    body: form_data,
  }).then(async function (response) {
    data = await response.json();
    document.getElementById("message").innerText = data["message"]; 
  });
  get_info();
}
async function get_info() {
  let url = "/api/user.php?action=detail_info";
  let response = await fetch(url);
  let data = await response.json();
  document.getElementById("money").innerText = data["message"]["money"];
  document.getElementById("sender_id").value = data["message"]["id"];
}

async function get_user_info() {
  const queryString = window.location.search; // ?id=4
  const urlParams = new URLSearchParams(queryString);
  const id = urlParams.get('id'); //4
  var url = `/api/user.php?action=public_info&id=${id}`;
  var response = await fetch(url);
  return await response.json();
}

function main() {
  get_user_info().then(function (data) {
    document.getElementById("image").src = data["message"]["image"];
    document.getElementById("id").innerText = data["message"]["id"];
    document.getElementById("username").innerText += ' ' + data["message"]["username"];
    document.getElementById("credit_card").innerText += ' ' + (data["message"]["plain_credit_card"] === undefined) ? "************" : "";
    document.getElementById("bio").innerText = data["message"]["bio"];
  });
}
main();

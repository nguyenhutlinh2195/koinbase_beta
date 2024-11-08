const uploadFileBtn = document.getElementById("upload-file-btn");

uploadFileBtn.onclick = async () => {
  $("#loading_gif_fetch_image").show();
  const url = encodeURI(document.getElementById("url").value);
  const uploadUrl = encodeURI(document.getElementById("upload-url").value);
  await fetch(`${uploadUrl}/index.php?url=${url}`)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      const { status_code, message } = data;
      if (status_code !== 200) {
        displayError(message);
      } else {
        $("#result_fetch_image").html(
          '<div class="nes-text is-success">Successfully</div>'
        );
        $("#loading_gif_fetch_image").hide();
        const imageUrl =
          document.getElementById("upload-url").value + "/" + message;
        document.getElementById("img_form").value = imageUrl;
        document.getElementById("image").src = imageUrl;
      }
    });
};

function updateBio(event) {
  event.preventDefault();

  let form_data = new URLSearchParams();
  form_data.append("credit_card", event.target.elements.credit_card.value);
  form_data.append("bio", event.target.elements.bio.value);
  form_data.append("image", event.target.elements.image.value);

  fetch("/api/user.php?action=update_info", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: form_data,
  }).then((response) => response.json())
    .then((data) => {
      if (data["status_code"] == 200) $("#msg-success").text(data["message"]);
      else $("#msg-error").text(data["message"]);
    });
}

function displayError(message) {
  $("#result_fetch_image").html(
    `<div class="nes-text is-error">${message}</div>`
  );
  $("#loading_gif_fetch_image").hide();
}

async function responseUploadFile() {
  const uploadUrl = encodeURI(document.getElementById("upload-url").value);
  var url = uploadUrl + "/index.php";
  var response = await fetch(url);
  return await response.json();
}

async function display() {
  var url = "/api/user.php?action=detail_info";
  var response = await fetch(url);
  return await response.json();
}

function main() {
  display().then(function (data) {
    if (data) {
      document.getElementById("bio").value = data["message"]["bio"];
      document.getElementById("image").src = data["message"]["image"];
      document.getElementById("credit_card").value =
        data["message"]["plain_credit_card"] === undefined
          ? "************"
          : data["message"]["plain_credit_card"];
      document.getElementById("money").innerText += data["message"]["money"];
      if ("flag" in data.message) {
        document.getElementById("flag").innerText =
          "Flag: " + data["message"]["flag"];
      }
      document.getElementById("user-id").innerText += data["message"]["id"];
      document.getElementById("username").innerText +=
        data["message"]["username"];
    }
  });
}
main();

async function getHallOfFame() {
    var url = "/api/user.php?action=hall_of_fame";
    var response = await fetch(url);
    return await response.json();
}


function main() {
    const queryString = window.location.search; //window.location.search để lấy giá trị url sau dấu ?, ở đây là tham số "page = 1"
    const urlParams = new URLSearchParams(queryString);
    const page = urlParams.get('page'); //untrusted data

    let pageIndex = parseInt(page) - 1;
    let itemsPerPage = 5;

    document.getElementById("page-number").innerHTML = "Page " + page;  //sink = innerHTML là hàm diễn giải nội dung của page thành mã HTML, có nghĩa thì khi chèn script vào nó sẽ render code script dưới dạng HTML --> XSS. Để ngăn chặn XSS, thay vì innerHTML, nên dùng innerText hoặc textContent để chỉ hiển thị văn bản mà không diễn giải như HTML: document.getElementById("page-number").innerText = "Page " + page;

    getHallOfFame().then(function (data) {
        document.getElementById("hof-body").innerHTML = '';
        for (i = pageIndex * itemsPerPage; i < ((pageIndex * itemsPerPage) + itemsPerPage) && i < data["message"].length; i++) {
            let elem = data["message"][i];
            tr = document.createElement("tr");
            for (attr in elem) {
                td = document.createElement("td");
                td.innerText = elem[attr];
                tr.appendChild(td);
            }
            td = document.createElement("td");
            view = document.createElement("a");
            view.href = `/view.php?id=${elem['id']}`;
            view.innerText = "View";
            td.appendChild(view);
            tr.appendChild(td);
            document.getElementById("hof-body").appendChild(tr);
        }
    });
}

main();
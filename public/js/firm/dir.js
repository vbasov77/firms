const escapeHtml = (unsafe) => {
    return unsafe.replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;').replaceAll('"', '&quot;').replaceAll("'", '&#039;');
}

function openDirForm() {
    document.getElementById("dirForm").style.display = "block";
}

function closeDirForm() {
    document.getElementById("dirForm").style.display = "none";
}

window.addEventListener("load", () => {
    // Run Ajax
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/get_dir",
        type: "get",
        dataType: 'json',
        data: {
            user_id: user_id,
            firm_id: firm_id,
        },
        success: function (res) {
            let inHTML = '';
            for (let i = 0; i < res.arrayDir.length; i++) {
                let date = new Date(res.arrayDir[i].created_at);
                let _html = `<div class="dir">
                <small  class="mb-0">${res.arrayDir[i].comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
                inHTML += _html;
                $('div#dir').html(inHTML);
            }
        }
    });
});

const formElDir = document.querySelector('#addDir'); // Запрет перехода по ....
formElDir.addEventListener('submit', event => {
    event.preventDefault();
    const data = {
        "user_id": user_id,
        "firm_id": firm_id,
        "comment_text": escapeHtml($("#name_text").val()),
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/add_dir',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
            let date = new Date(res.date);
            const _html = `<div class="dir">
                <small  class="mb-0">${res.comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
            if (res.boolDir === true) {
                document.getElementById("dirForm").style.display = "none";
                $("#infoDir").show('slow');
                setTimeout(function() { $("#infoDir").hide('slow'); }, 2000);
                $("#dir").prepend(_html);
                $("#dir_text").val('');
            }
        }
    });
});


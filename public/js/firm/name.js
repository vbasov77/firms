
function openNameForm() {
    document.getElementById("nameForm").style.display = "block";
}

function closeNameForm() {
    document.getElementById("nameForm").style.display = "none";
}

window.addEventListener("load", () => {
    // Run Ajax
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/get_name",
        type: "get",
        dataType: 'json',
        data: {
            user_id: user_id,
            firm_id: firm_id,
        },
        success: function (res) {
            let inHTML = '';
            for (let i = 0; i < res.arrayName.length; i++) {
                let date = new Date(res.arrayName[i].created_at);
                let _html = `<div class="name">
                <small  class="mb-0">${res.arrayName[i].comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
                inHTML += _html;
                $('div#name').html(inHTML);
            }
        }
    });
});

const aElName = document.querySelector('#addName'); // Запрет перехода по ....
aElName.addEventListener('submit', event => {
    event.preventDefault();

        data = {
            "user_id": user_id,
            "firm_id": firm_id,
            "comment_text": $("#name_text").val(),
        };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/add_name',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
            let date = new Date(res.date);
            const _html = `<div class="name">
                <small  class="mb-0">${res.comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
            if (res.boolName === true) {
                document.getElementById("nameForm").style.display = "none";
                $("#infoName").show('slow');
                setTimeout(function() { $("#infoName").hide('slow'); }, 2000);
                $("#name").prepend(_html);
                $("#name_text").val('');
            }
        }
    });
});


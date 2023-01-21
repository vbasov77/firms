
function openPhForm() {
    document.getElementById("phForm").style.display = "block";
}

function closePhForm() {
    document.getElementById("phForm").style.display = "none";
}

window.addEventListener("load", () => {
    // Run Ajax
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/get_ph",
        type: "get",
        dataType: 'json',
        data: {
            user_id: user_id,
            firm_id: firm_id,
        },
        success: function (res) {
            let inHTML = '';
            for (let i = 0; i < res.arrayPh.length; i++) {
                let date = new Date(res.arrayPh[i].created_at);
                let _html = `<div class="ph">
                <small  class="mb-0">${res.arrayPh[i].comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
                inHTML += _html;
                $('div#ph').html(inHTML);
            }
        }
    });
});

const formElPh = document.querySelector('#addPh'); // Запрет перехода по ....
formElPh.addEventListener('submit', event => {
    event.preventDefault();

        const data = {
            "user_id": user_id,
            "firm_id": firm_id,
            "comment_text": $("#ph_text").val(),
        };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/add_ph',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
            let date = new Date(res.date);
            const _html = `<div class="ph">
                <small  class="mb-0">${res.comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
            if (res.boolPh === true) {
                document.getElementById("phForm").style.display = "none";
                $("#infoPh").show('slow');
                setTimeout(function() { $("#infoPh").hide('slow'); }, 2000);
                $("#ph").prepend(_html);
                $("#ph_text").val('');
            }
        }
    });
});


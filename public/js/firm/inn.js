function openForm() {
    document.getElementById("innForm").style.display = "block";
}

function closeForm() {
    document.getElementById("innForm").style.display = "none";
}

window.addEventListener("load", () => {
    // Run Ajax
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/get_inn",
        type: "get",
        dataType: 'json',
        data: {
            user_id: user_id,
            firm_id: firm_id,
        },
        success: function (res) {
            let inHTML = '';
            for (let i = 0; i < res.arrayInn.length; i++) {
                let date = new Date(res.arrayInn[i].created_at);
                let _html = `<div class="inn">
                <small  class="mb-0">${res.arrayInn[i].comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
                inHTML += _html;
                $('div#inn').html(inHTML);
            }
        }
    });
});

const aEl = document.querySelector('#add_inn'); // Запрет перехода по ....
aEl.addEventListener('submit', event => {
    event.preventDefault();
    let his = $(this),
        data = {
            "user_id": user_id,
            "firm_id": firm_id,
            "comment_text": $("#inn_text").val(),
        };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/add_inn',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
            let date = new Date(res.date);
            const _html = `<div class="inn">
                <small  class="mb-0">${res.comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
            if (res.boolInn === true) {
                document.getElementById("innForm").style.display = "none";
                $("#infoInn").show('slow');
                setTimeout(function() { $("#infoInn").hide('slow'); }, 2000);
                $("#inn").prepend(_html);
                $("#inn_text").val('');
            }
        }
    });
});


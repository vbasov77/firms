function openAddrForm() {
    document.getElementById("addrForm").style.display = "block";
}

function closeAddrForm() {
    document.getElementById("addrForm").style.display = "none";
}

window.addEventListener("load", () => {
    // Run Ajax
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/get_addr",
        type: "get",
        dataType: 'json',
        data: {
            user_id: user_id,
            firm_id: firm_id,
        },
        success: function (res) {
            let inHTML = '';
            for (let i = 0; i < res.arrayAddr.length; i++) {
                let date = new Date(res.arrayAddr[i].created_at);
                let _html = `<div class="addr">
                <small  class="mb-0">${res.arrayAddr[i].comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
                inHTML += _html;
                $('div#addr').html(inHTML);
            }
        }
    });
});

const formElAddr = document.querySelector('#addAddr'); // Запрет перехода по ....
formElAddr.addEventListener('submit', event => {
    event.preventDefault();

    const data = {
        "user_id": user_id,
        "firm_id": firm_id,
        "comment_text": $("#addr_text").val(),
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/add_addr',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
            let date = new Date(res.date);
            const _html = `<div class="addr">
                <small  class="mb-0">${res.comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
            if (res.boolAddr === true) {
                document.getElementById("addrForm").style.display = "none";
                $("#infoAddr").show('slow');
                setTimeout(function() { $("#infoAddr").hide('slow'); }, 2000);
                $("#addr").prepend(_html);
                $("#addr_text").val('');
            }
        }
    });
});


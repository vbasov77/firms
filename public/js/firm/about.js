function openAboutForm() {
    document.getElementById("aboutForm").style.display = "block";
}

function closeAboutForm() {
    document.getElementById("aboutForm").style.display = "none";
}

window.addEventListener("load", () => {
    // Run Ajax
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/get_about",
        type: "get",
        dataType: 'json',
        data: {
            user_id: user_id,
            firm_id: firm_id,
        },
        success: function (res) {
            let inHTML = '';
            for (let i = 0; i < res.arrayAbout.length; i++) {
                let date = new Date(res.arrayAbout[i].created_at);
                let _html = `<div class="about">
                <small  class="mb-0">${res.arrayAbout[i].comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
                inHTML += _html;
                $('div#about').html(inHTML);
            }
        }
    });
});

const aElAbout = document.querySelector('#addAbout'); // Запрет перехода по ....
aElAbout.addEventListener('submit', event => {
    event.preventDefault();

    let hisAbout = $(this),
        data = {
            "user_id": user_id,
            "firm_id": firm_id,
            "comment_text": $("#about_text").val(),
        };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/add_about',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (res) {
            let date = new Date(res.date);
            const _html = `<div class="about">
                <small  class="mb-0">${res.comment_text}</small >
                <small  style="font-size: 10px" class="mb-0 text-left">${date.toLocaleString()}</small >
                </div>`;
            if (res.boolAbout === true) {
                document.getElementById("aboutForm").style.display = "none";
                $("#infoAbout").show('slow');
                setTimeout(function() { $("#infoAbout").hide('slow'); }, 2000);
                $("#about").prepend(_html);
                $("#about_text").val('');
            }
        }
    });
});


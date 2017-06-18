$(document).ready(function () {
    $("body").on("click", "input", function () {
        if ($(this).val()) {
            alert('Field occupied');
        } else {
            var field = $(this);
            $.ajax({
                method: "POST",
                url: "../ajax.php",
                dataType: "json",
                data: {'fieldCoordinate': $(this).attr('name')}
            })
                .done(function (result) {
                    field.val(result['sign']);
                    if (result['gameState'] == 'End') {
                        clearGame();
                        alert(result['message']);
                    } else if (result['gameState'] == 'Draw') {
                        clearGame();
                        alert('Draw');
                    }
                }).fail(function () {
                console.log("game error");
            });
        }

    });

    function clearGame() {
        $('input').val('');

        $.ajax({
            method: "POST",
            url: "../ajax.php",
            dataType: "json",
            data: {'sessionClear': 1}
        })
            .done(function (result) {
                console.log(result['state']);
            }).fail(function () {
            console.log("session clear error");
        });
    }
});

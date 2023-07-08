// login

$("#login_form").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    var form = $(this);
    $.ajax({
        url: "/auth/login",
        type: "POST",
        data: formData,
        success: function (response) {
            console.log(response)
            if (response.success !== undefined && response.success.trim() !== "") {
                $("#success").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.success);
                form.trigger("reset");
            }
            if (response.warning !== undefined && response.warning.trim() !== "") {
                $("#warning").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.warning);
            }

            if (response.criticalError !== undefined && response.criticalError.trim() !== "") {
                $("#criticalError").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.criticalError);
            }

            if (response.redirect && response.redirect.trim() !== "") {
                if (response.messageRedirect && response.messageRedirect.trim() !== "") {
                    if (response.redirect_type === 'success') {
                        $("#success").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'warning') {
                        $("#warning").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'error') {
                        $("#criticalError").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    }
                }
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, response.redirect_time);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});
// register

$("#register_form").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    var form = $(this);
    $.ajax({
        url: "/auth/register",
        type: "POST",
        data: formData,
        success: function (response) {
            console.log(response)
            if (response.success !== undefined && response.success.trim() !== "") {
                $("#success").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.success);
                form.trigger("reset");
            }
            if (response.warning !== undefined && response.warning.trim() !== "") {
                $("#warning").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.warning);
            }

            if (response.criticalError !== undefined && response.criticalError.trim() !== "") {
                $("#criticalError").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.criticalError);
            }

            if (response.redirect && response.redirect.trim() !== "") {
                if (response.messageRedirect && response.messageRedirect.trim() !== "") {
                    if (response.redirect_type === 'success') {
                        $("#success").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'warning') {
                        $("#warning").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'error') {
                        $("#criticalError").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    }
                }
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, response.redirect_time);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});


$(".remove_news").click(function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    var element = $(this); // Сохраняем ссылку на текущий элемент

    $.ajax({
        url: "/news/remove",
        type: "POST",
        data: { id: id },
        success: function (response) {
            if (response.success !== undefined && response.success.trim() !== "") {
                $("#success").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.success);

                // Анимация при удалении элемента
                element.closest(".articles__item").fadeOut(100, function() {
                    $(this).remove();
                });
            }
            if (response.warning !== undefined && response.warning.trim() !== "") {
                $("#warning").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.warning);
            }

            if (response.criticalError !== undefined && response.criticalError.trim() !== "") {
                $("#criticalError").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.criticalError);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});

$("#form_save_statistic").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    var form = $(this);
    $.ajax({
        url: "/statistic/save",
        type: "POST",
        data: formData,
        success: function (response) {
            setTimeout(() => {
                location.reload();
            },500)
            if (response.success !== undefined && response.success.trim() !== "") {
                $("#success").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.success);
                form.trigger("reset");
            }
            if (response.warning !== undefined && response.warning.trim() !== "") {
                $("#warning").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.warning);
            }

            if (response.criticalError !== undefined && response.criticalError.trim() !== "") {
                $("#criticalError").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.criticalError);
            }

            if (response.redirect && response.redirect.trim() !== "") {
                if (response.messageRedirect && response.messageRedirect.trim() !== "") {
                    if (response.redirect_type === 'success') {
                        $("#success").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'warning') {
                        $("#warning").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'error') {
                        $("#criticalError").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    }
                }
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, response.redirect_time);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});

$("#form_save_config").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    var form = $(this);
    $.ajax({
        url: "/config/save",
        type: "POST",
        data: formData,
        success: function (response) {

            if (response.success !== undefined && response.success.trim() !== "") {
                $("#success").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.success);
                form.trigger("reset");
            }
            if (response.warning !== undefined && response.warning.trim() !== "") {
                $("#warning").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.warning);
            }

            if (response.criticalError !== undefined && response.criticalError.trim() !== "") {
                $("#criticalError").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.criticalError);
            }

            if (response.redirect && response.redirect.trim() !== "") {
                if (response.messageRedirect && response.messageRedirect.trim() !== "") {
                    if (response.redirect_type === 'success') {
                        $("#success").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'warning') {
                        $("#warning").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'error') {
                        $("#criticalError").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    }
                }
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, response.redirect_time);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});

$("#form_save_config_game").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    var form = $(this);
    $.ajax({
        url: "/config/save/game",
        type: "POST",
        data: formData,
        success: function (response) {

            if (response.success !== undefined && response.success.trim() !== "") {
                $("#success").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.success);
                form.trigger("reset");
            }
            if (response.warning !== undefined && response.warning.trim() !== "") {
                $("#warning").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.warning);
            }

            if (response.criticalError !== undefined && response.criticalError.trim() !== "") {
                $("#criticalError").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.criticalError);
            }

            if (response.redirect && response.redirect.trim() !== "") {
                if (response.messageRedirect && response.messageRedirect.trim() !== "") {
                    if (response.redirect_type === 'success') {
                        $("#success").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'warning') {
                        $("#warning").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'error') {
                        $("#criticalError").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    }
                }
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, response.redirect_time);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});


$("#lang_edit").submit(function (event) {
    event.preventDefault();

    var formData = $(this).serialize();
    var form = $(this);
    $.ajax({
        url: "/lang/edit",
        type: "POST",
        data: formData,
        success: function (response) {
            console.log(response)
            if (response.success !== undefined && response.success.trim() !== "") {
                $("#success").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.success);
                form.trigger("reset");
            }
            if (response.warning !== undefined && response.warning.trim() !== "") {
                $("#warning").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.warning);
            }

            if (response.criticalError !== undefined && response.criticalError.trim() !== "") {
                $("#criticalError").show().delay(2000).fadeOut(500);
                $(".toast-body").text(response.criticalError);
            }

            if (response.redirect && response.redirect.trim() !== "") {
                if (response.messageRedirect && response.messageRedirect.trim() !== "") {
                    if (response.redirect_type === 'success') {
                        $("#success").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'warning') {
                        $("#warning").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    } else if (response.redirect_type === 'error') {
                        $("#criticalError").show().delay(2000).fadeOut(500);
                        $(".toast-body").text(response.messageRedirect);
                        form.trigger("reset");
                    }
                }
                setTimeout(() => {
                    window.location.href = response.redirect;
                }, response.redirect_time);
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
});
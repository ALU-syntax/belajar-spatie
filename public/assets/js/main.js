$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name=csrf_token]').attr('content')
    }
})

showLoader()
$(document).ready(function() {
    showLoader(false)
})

function handleAction(datatable, onShowAction, onSuccessAction){
    $('.main-content').on('click', '.action', function(e) {
        e.preventDefault();
        handleAjax(this.href).onSuccess(function(res) {
            onShowAction && onShowAction(res)
            handleFormSubmit('#form_action')
                .setDataTable(datatable)
                .onSuccess(function(res){
                    onSuccessAction && onSuccessAction(res)
                })
                .init();
        }).excute();
    });

}

function showLoader(show = true) {
    const preloader = $(".preloader");

    if (show) {
        preloader.css({
            opacity: 1,
            visibility: "visible",
        });
    } else {
        preloader.css({
            opacity: 0,
            visibility: "hidden",
        });
    }
}

function submitLoader(formId = '#form_action') {
    const button = $(formId).find('button[type="submit"]');


    function show() {
        button.addClass("btn-load").attr("disabled", true).html(
            `<span class="d-flex align-items-center">
        <span class="spinner-border flex-shrink-0"></span><span class="flex-grow-1 ms-2"> Loading...  </span></span>`
        );

    }

    function hide(text = "Save") {
        button.removeClass("btn-load").removeAttr("disabled").text(text);
    }

    return {
        show,
        hide,
    };
}

function showToast(status = 'success', message){
    iziToast[status]({
        title: status == 'success' ? 'Success' : 'Error',
        message: message,
        position: 'topRight'
    });
}

function handleFormSubmit(selector) {
    function init() {
        const _this = this;
        $(selector).on('submit', function(e) {
            e.preventDefault();
            const _form = this
            $.ajax({
                url: this.action,
                method: this.method,
                data: new FormData(_form),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(_form).find('.is-invalid').removeClass('is-invalid')
                    $(_form).find(".invalid-feedback").remove()
                    submitLoader().show()
                },
                success: (res) => {
                    if (_this.runDefaultSuccessCallback) {
                        $('#modal_action').modal('hide')
                        showToast(res.status, res.message)
                    }

                    _this.onSuccessCallback && _this.onSuccessCallback(res)
                    _this.dataTableId && window.LaravelDataTables[_this.dataTableId].ajax.reload()

                },
                complete: function() {
                    submitLoader().hide()
                },
                error: function(err) {
                    const errors = err.responseJSON?.errors

                    if (errors) {
                        for (let [key, message] of Object.entries(errors)) {
                            console.log(message);
                            $(`[name=${key}]`).addClass('is-invalid')
                                .parent()
                                .append(
                                    `<div class="invalid-feedback">${message}</div>`
                                )
                        }
                    }

                    showToast('error', err.responseJSON?.message)
                }
            })
        })
    }

    function onSuccess(cb, runDefault = true) {
        this.onSuccessCallback = cb
        this.runDefaultSuccessCallback = runDefault

        return this
    }

    function setDataTable(id) {
        this.dataTableId = id

        return this
    }

    return {
        init,
        runDefaultSuccessCallback: true,
        onSuccess,
        setDataTable
    }
}

function handleAjax(url, method = 'get') {

    function onSuccess(cb, runDefault = true) {
        this.onSuccessCallback = cb
        this.runDefaultSuccessCallback = runDefault

        return this
    }

    function excute() {
        $.ajax({
            url,
            method,
            beforeSend: function() {
                showLoader()
            },
            complete: function() {
                showLoader(false)
            },
            success: (res) => {
                if (this.runDefaultSuccessCallback) {
                    const modal = $('#modal_action');
                    modal.html(res);
                    modal.modal('show');
                }

                this.onSuccessCallback && this.onSuccessCallback(res)
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function onError(cb) {
        this.onErrorCallback = cb
        return this
    }

    return {
        excute,
        onSuccess,
        runDefaultSuccessCallback: true
    }

}
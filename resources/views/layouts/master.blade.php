<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash; Arfa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('') }}vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('') }}vendor/perfect-scrollbar/css/perfect-scrollbar.css">
    <link href="{{ asset('') }}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="{{ asset('') }}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('') }}vendor/izitoast/css/iziToast.min.css">

    <!-- CSS for this page only -->
    @stack('cssLibrary')

    <!-- End CSS  -->

    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap-override.min.css">
    <link rel="stylesheet" id="theme-color" href="{{ asset('') }}assets/css/dark.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/css/loading.css">
    @stack('css')
</head>

<body>
    <div id="app">
        <div class="shadow-header"></div>
        @include('layouts.header')
        @include('layouts.sidebar')
        <div class="modal fade" id="modal_action" tabindex="-1" aria-labelledby="largeModalLabel"aria-hidden="true">
        </div>
        {{ $slot }}

        @include('layouts.settings')

        <footer>
            Copyright © 2022 &nbsp <a href="https://www.youtube.com/c/mulaidarinull" target="_blank" class="ml-1">
                Mulai Dari Null </a> <span> . All rights Reserved</span>
        </footer>
        <div class="overlay action-toggle">
        </div>
        <div class="preloader" style="visibility:hidden;">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('') }}vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('') }}vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{ asset('') }}vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('') }}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('') }}vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('') }}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('') }}vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('') }}assets/js/pages/datatables.min.js"></script>
    <script src="{{ asset('') }}vendor/izitoast/js/iziToast.min.js"></script>

    <!-- js for this page only -->
    @stack('jsLibrary')

    <!-- ======= -->
    <script src="{{ asset('') }}assets/js/main.min.js"></script>
    <script>
        Main.init()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf_token]').attr('content')
            }
        })
        
        showLoader()
        $(document).ready(function() {
            showLoader(false)
        })

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
    </script>
    @stack('js')
</body>

</html>

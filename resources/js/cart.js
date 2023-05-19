"use strict";

import './bootstrap';
import $ from 'jquery';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

let $orderCount = $('.OrderCount');

let sum = 0;

function calcCount() {
    let $prices = $('.productPrice');

    $prices.each(function () {
        sum += parseInt($(this).data('num') * $(this).data('quantity'));

    });

    $orderCount.text(sum);
}

calcCount()
//order placement function
$('.orderBtn').on('click', () => {
    Swal.fire({
        title: 'Введите пароль для подтверждения',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Оформить',
        cancelButtonText: 'Закрыть',
        showLoaderOnConfirm: true,
        preConfirm: (password) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/checkPassword',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    value: 'cartAuth',
                    password: password,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response, data) {

                    if (response.logged == true) {
                        console.log(response)
                        Swal.fire(
                            'Успешно!',
                            'Заказ успешно оформлен',
                            'success'
                        ).then(function () {
                            window.location.href = response.url;
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Упсс...',
                            text: 'Пароль введен неверно',
                        })

                    }

                },
                error: function (response, data) {
                    console.log(response)
                    console.log('error')
                }
            });

        },
        allowOutsideClick: () => !Swal.isLoading()
    })
})

//cart edit function
$(".cartForm").submit(function (e) {
    e.preventDefault();

    const id = $(this).data('cart-id');
    const cart_id = $(this).data('cart-id');
    const token = $('meta[name="csrf-token"]').attr('content');
    let cartForm = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'cart/' + id,
        method: 'POST',
        dataType: 'JSON',
        data: {
            id: id,
            value: e.originalEvent.submitter.value,
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response, data) {

            if (e.originalEvent.submitter.value == 'decrement') {

                cartForm.children('.productCount').text(response.count - 1);
                location.reload();
                return false;

                if (response.count == 1) {
                    cartForm.closest('.card').remove()
                }

            } else if (response.count != null) {
                cartForm.children('.productCount').text(response.count + 1)

                location.reload();
                return false;

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Упсс...',
                    text: 'Товара нет в наличии',
                })
            }

        },
        error: function (response, data) {

            console.log('error')
        }
    });
})

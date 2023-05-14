"use strict";

import './bootstrap';
import $ from 'jquery';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'


//category add function

$('.categoryAddBtn').on('click', () => {
    openForm()
})

$('.overlay').on('click', (e) => {
    e.preventDefault()
    closeForm()
})

$('.closeBtn').on('click', (e) => {
    e.preventDefault()
    closeForm()
})

//product add function
$('.productAddBtn').on('click', () => {
    openForm()
})

function openForm() {
    $('.overlay').addClass('active')
    $('.overlay_form_block').addClass('active')
}

function closeForm() {
    $('.overlay').removeClass('active')
    $('.overlay_form_block').removeClass('active')
}

$('.overlay').on('click', (e) => {
    e.preventDefault()
    closeForm()
})

$('.closeBtn').on('click', (e) => {
    e.preventDefault()
    closeForm()
})


//add to cart function
$(".addToCartForm").submit(function (e) {
    e.preventDefault();
    const id = $(this).data('product-id');
    const user_id = $(this).data('user-id');
    const token = $('meta[name="csrf-token"]').attr('content');
    let form = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'products/' + id,
        method: 'POST',
        dataType: 'JSON',
        data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content'),
            user_id: user_id,
        },
        success: function (response, data, form) {

            if (response.added != false) {
                Swal.fire(
                    'Успешно!',
                    'Товар успешно добавлен в корзину',
                    'success'
                ).then(function () {
                    location.reload();
                    return false;
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Упсс...',
                    text: 'Товара нет в наличии',
                })
            }
        },
        error: function (response, data) {
            console.log(response)
            console.log(data)
            console.log('error')
        }
    });
})

//add to cart in product-page function
$(".addToCartFormShow").submit(function (e) {
    e.preventDefault();
    const id = $(this).data('product-id');
    const user_id = $(this).data('user-id');
    const token = $('meta[name="csrf-token"]').attr('content');
    let form = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: document.URL,
        method: 'POST',
        dataType: 'JSON',
        data: {
            id: id,
            _token: $('meta[name="csrf-token"]').attr('content'),
            user_id: user_id,
        },

        success: function (response, data, form) {

            if (response.added != false) {
                Swal.fire(
                    'Успешно!',
                    'Товар успешно добавлен в корзину',
                    'success'
                ).then(function () {
                    location.reload();
                    return false;
                })

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Упсс...',
                    text: 'Товара нет в наличии',
                })
            }
        },
        error: function (response, data) {
            console.log(response)
            console.log(data)
            console.log('error')
        }
    });
})




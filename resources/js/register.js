"use strict";

import './bootstrap';
import $ from 'jquery';
import JustValidate from 'just-validate';


const validator = new JustValidate('#regForm');

validator
    .addField('#surname', [
        {
            rule: 'required',
            errorMessage: 'Поле не должно быть пустым',
        },
        {
            rule: 'minLength',
            value: 5,
            errorMessage: 'Минимальная длина фамилии 5 символов',
        },
        {
            rule: 'maxLength',
            value: 15,
            errorMessage: 'Максимальная длина фамилии 15 символов',
        },
    ])
    .addField('#name', [
        {
            rule: 'required',
            errorMessage: 'Поле не должно быть пустым',
        },
        {
            rule: 'minLength',
            value: 5,
            errorMessage: 'Минимальная длина имени 5 символов',
        },
        {
            rule: 'maxLength',
            value: 15,
            errorMessage: 'Максимальная длина имени 15 символов',
        },
    ])

    .addField('#login', [
        {
            rule: 'required',
            errorMessage: 'Поле не должно быть пустым',
        },
        {
            rule: 'minLength',
            value: 4,
            errorMessage: 'Минимальная длина логина 4 символов',
        },
        {
            rule: 'maxLength',
            value: 15,
            errorMessage: 'Максимальная длина логина 15 символов',
        },
    ])
    .addField('#email', [
        {
            rule: 'required',
            errorMessage: 'Поле не должно быть пустым',
        },
        {
            rule: 'email',
            errorMessage: 'Введите свой email',
        },

    ])
    .addField('#password', [
        {
            rule: 'required',
            errorMessage: 'Поле не должно быть пустым',
        },
        {
            rule: 'minLength',
            value: 6,
            errorMessage: 'Минимальная длина пароля 6 символов',
        },
        {
            rule: 'maxLength',
            value: 15,
            errorMessage: 'Максимальная длина пароля 15 символов',
        },
    ])
    .addField('#confpassword', [
        {
            rule: 'required',
            errorMessage: 'Поле не должно быть пустым',
        },
        {
            validator: (value, fields) => {
                if (
                    fields['#password'] &&
                    fields['#password'].elem
                ) {
                    const repeatPasswordValue =
                        fields['#password'].elem.value;

                    return value === repeatPasswordValue;
                }

                return true;
            },
            errorMessage: 'Пароли должны совпадать',
        },
    ])
    .addField('#rules', [
        {
            rule: 'required',
            errorMessage: 'Примите условия',
        },
    ])
;

validator.onSuccess((event) => {
    console.log('Validation passes and form submitted', event);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: 'register',
        method: 'POST',
        data: $(".regForm").serialize(),

        success: function (response) {
            console.log('success')
            console.log(response)
            if (response.status == 200) {
                window.location.href = response.url;
            }
            if (response.message) {
                $('.message').html(response.message)
            }
        },
        error: function () {
            console.log('error')
        }
    });
});



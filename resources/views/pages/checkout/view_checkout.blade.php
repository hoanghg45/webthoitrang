<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">




<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="flexbox">

<head>
    <link rel="icon" href="{{ asset('public/frontend/images/favi_3h.png') }}" type="image/png">
    <title>
         Thanh toán đơn hàng
    </title>

    <meta name="description" content="Thanh to&#225;n đơn h&#224;ng" />






    
    <link href="public/frontend/css/checkout.css" rel="stylesheet">
    <link href='//theme.hstatic.net/1000333436/1000835503/14/check_out.css?v=218' rel='stylesheet' type='text/css' media='all' />
    <script src='//hstatic.net/0/0/global/jquery.min.js' type='text/javascript'></scrip>

    <script src='//hstatic.net/0/0/global/jquery.validate.js' type='text/javascript'></script>


    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=no">
    <script type="text/javascript">
        var parseQueryString = function(url) {

            var str = url;
            var objURL = {};

            str.replace(
                new RegExp("([^?=&]+)(=([^&]*))?", "g"),
                function($0, $1, $2, $3) {

                    if ($3 != undefined && $3 != null)
                        objURL[$1] = decodeURIComponent($3);
                    else
                        objURL[$1] = $3;
                });

            return objURL;
        };
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                var stepCheckout = parseInt($('.step-sections').attr('step'));
                if (stepCheckout === 1) {
                    var flagVal = 0;
                    $('body').on('change', '#stored_addresses', function() {
                        flagVal = $(this).val();
                    });
                    $('body').on('click', '.step-footer-continue-btn', function() {
                        $(document).ajaxComplete(function(event, xhr, settings) {
                            if (settings.url.indexOf("form_next_step") > -1) {
                                $('#stored_addresses').val(flagVal);
                            }
                        });
                    })

                    function check_required() {
                        $('.field-required').each(function() {
                            var self = $(this).find('input');
                            var selfSelect = $(this).find('select');

                            if (self.val() !== '') {
                                self.parent().next().remove();
                                self.parents('.field-error').removeClass('field-error')
                            }

                            if (selfSelect !== null || selfSelect !== 0) {
                                selfSelect.parent().next().remove();
                                selfSelect.parents('.field-error').removeClass('field-error')
                            }
                        });
                    }
                    $('body').on('change', '#stored_addresses', function() {
                        check_required();
                    });

                }
            }, 0)
        })
    </script>

    <script type="text/javascript">
        window.onpageshow = function(event) {
            if (event.persisted) {
                var currentUrl = '';

                currentUrl = '/checkouts/9379a365d24e4fccba2453af2bd95dc9?step=1';


                if (currentUrl)
                    window.location = currentUrl;
            }
        };



        var isInit = false;

        const paylayterLoadingTrigger = (isLoading = true) => {
            if (isLoading) {
                $('.payment-later-table').addClass('hidden');
                $('.paylater--ul').addClass('hidden');
                $('.payment-later-table--loading').addClass('show');
                $('.checkout-payment__loading--box').addClass('show');
            } else {
                $('.checkout-payment__loading--box').removeClass('show');
                $('.payment-later-table--loading').removeClass('show');
                $('.payment-later-table').removeClass('hidden');
                $('.paylater--ul').removeClass('hidden');
            }
        }

        function funcFormOnSubmit(e) {
            if (!isInit) {
                isInit = true;

                $.fn.tagName = function() {
                    return this.prop("tagName").toLowerCase();
                };
            }

            // update new version 
            let oldVer = $('.checkout_version')
            $(oldVer).attr('data_checkout_version', oldVer++);
            //----------
            if (typeof(e) == 'string') {
                var element = $(e);
                var formData = e;
            } else {
                var element = this;
                var formData = this;
                e.preventDefault();
            }

            $(element).find('button:submit').addClass('btn-loading');

            let formId = $(element).attr('id'),
                replaceElement = [],
                funcCallback;
            if (formId == undefined || formId == null || formId == '')
                return;

            const findPaymentMethodId = $('body').find('input:radio[name$="payment_method_id"]:checked').attr('type-id');

            const isReePay = findPaymentMethodId == 41 || findPaymentMethodId == 43


            if (['section-payment-method', 'form_discount_add', 'section-shipping-rate'].includes(formId) && isReePay) {
                if (findPaymentMethodId == 41) {
                    $('#section-pay-later-method').removeClass('hidden');
                }
                if (findPaymentMethodId == 43) {
                    $('#section-pay-later-method-kredivo').removeClass('hidden');
                }
                paylayterLoadingTrigger()
            }

            if (formId == 'form_update_location_customer_shipping' || formId == 'form_update_shipping_method') {
                if ($('.order-checkout__loading--box').length > 0) {
                    $('.order-checkout__loading--box').addClass('show');
                }
            }


            if (formId == 'form_next_step') {
                formData = '.step-sections';
                replaceElement = [...replaceElement,
                    '.step-sections', '.order-summary-sections',
                    '#checkout_order_information_changed_error_message'
                ]
            } else if (
                formId == 'form_redeem_add' ||
                formId == 'form_redeem_remove' ||
                formId == 'form_discount_add' ||
                formId == 'form_discount_remove' ||
                formId == 'section-payment-method' ||
                formId == 'form_update_shipping_method'

                ||
                formId == 'form_update_shipping_method'


                ||
                formId == 'section-shipping-rate'

            ) {
                replaceElement = [...replaceElement, '#checkout_order_information_changed_error_message', '#form_update_shipping_method', '#change_pick_location_or_shipping',
                    '.inventory_location_data',
                    '.order-summary-toggle-inner .order-summary-toggle-total-recap',
                    '.order-summary-sections',
                    '.order-summary-section.order-summary-section-total-lines.total-line-table.total-line-table-footer',
                    '.order-summary-section.order-summary-section-total-lines.total-line-table.total-line.total-line-redeem',
                    '.order-summary-section.order-summary-section-redeem.redeem-login-section'
                ]

                replaceElement.push('#section-shipping-rate');

            }


            if (formId == 'form_update_location_customer_shipping') {
                formId = 'form_update_shipping_method';
                replaceElement = [...replaceElement,
                    '#form_update_location_customer_shipping',
                    '#change_pick_location_or_shipping',
                    '.inventory_location_data',
                    '.order-summary-toggle-inner .order-summary-toggle-total-recap',
                    '.order-summary-sections',
                    '.order-summary-section.order-summary-section-total-lines.total-line-table.total-line-table-footer',
                    '.order-summary-section.order-summary-section-total-lines.total-line-table.total-line.total-line-redeem',
                    '.order-summary-section.order-summary-section-redeem.redeem-login-section',
                    '#checkout_order_information_changed_error_message'
                ]
            }
            if (formId == 'form_update_location_customer_pick_at_location') {
                formId = 'form_update_shipping_method';
                replaceElement = [...replaceElement,
                    '#form_update_location_customer_pick_at_location',
                    '#change_pick_location_or_shipping',
                    '.inventory_location_data',
                    '.order-summary-toggle-inner .order-summary-toggle-total-recap',
                    '.order-summary-sections',
                    '.order-summary-section.order-summary-section-total-lines.total-line-table.total-line-table-footer',
                    '.order-summary-section.order-summary-section-total-lines.total-line-table.total-line.total-line-redeem',
                    '.order-summary-section.order-summary-section-redeem.redeem-login-section',
                    '#checkout_order_information_changed_error_message'
                ]
            }





            replaceElement.push('#section-pay-later-method');
            replaceElement.push('#section-pay-later-method-kredivo')
            if (!$(formData) || $(formData).length == 0) {
                window.location.reload();
                return false;
            }

            var inputurl = '';

            if (($(formData).tagName() != 'form' && $(formData).tagName() != 'input' && $(formData).tagName() != 'div') ||
                ($(formData).tagName() == 'input' || $(formData).tagName() == 'div')) {

                formData += ' :input';
            }
            try {

                var listparameters = new URLSearchParams($(formData).serialize());

                var countrytmp = $('body').find('input[name$="selected_customer_shipping_country"]').val();
                if (countrytmp && countrytmp != '') {
                    listparameters.set('customer_shipping_country', countrytmp);
                }


                var provincetmp = $('body').find('input[name$="selected_customer_shipping_province"]').val();
                if (provincetmp && provincetmp != '' && provincetmp != "null") {
                    listparameters.set('customer_shipping_province', provincetmp);
                    var districttmp = $('body').find('input[name$="selected_customer_shipping_district"]').val();
                    if (districttmp && districttmp != '' && districttmp != "null") {
                        listparameters.set('customer_shipping_district', districttmp);
                        var wardtmp = $('body').find('input[name$="selected_customer_shipping_ward"]').val();
                        if (wardtmp && wardtmp != '') listparameters.set('customer_shipping_ward', wardtmp);
                    } else {
                        var districtid = listparameters.get('customer_shipping_district');
                        if (districtid == null || districtid == '' || districtid == "null" || districtid == 'null') {
                            listparameters.set('customer_shipping_district', '');
                            listparameters.set('customer_shipping_ward', '');
                        }
                    }
                } else {
                    var provinceid = listparameters.get('customer_shipping_province');
                    if (provinceid == null || provinceid == '' || provinceid == "null" || provinceid == 'null') {
                        var district = listparameters.get('customer_shipping_district')
                        if (district && district != '') {
                            listparameters.set('customer_shipping_district', '');
                        }

                        var ward = listparameters.get('customer_shipping_ward')
                        if (ward && ward != '') {
                            listparameters.set('customer_shipping_ward', '');
                        }
                    }
                }





                var address1tmp = $('body').find('input[name$="billing_address[address1]"]').val();
                if (address1tmp != '' && address1tmp != undefined) listparameters.set('billing_address[address1]', address1tmp);

                var phonetmp = $('body').find('input[name$="billing_address[phone]"]').val();
                if (phonetmp != '' && phonetmp != undefined) listparameters.set('billing_address[phone]', phonetmp);

                var emailtmp = $('body').find('input[name$="checkout_user[email]"]').val();
                if (emailtmp != '' && emailtmp != undefined) listparameters.set('checkout_user[email]', emailtmp);

                var fullnametmp = $('body').find('input[name$="billing_address[full_name]"]').val();
                if (fullnametmp != '' && fullnametmp != undefined) listparameters.set('billing_address[full_name]', fullnametmp);


                listparameters.delete('selected_customer_shipping_country');
                listparameters.delete('selected_customer_shipping_province');
                listparameters.delete('selected_customer_shipping_district');
                listparameters.delete('selected_customer_shipping_ward');

                if ($('body').find('input[name$="customer_pick_at_location"]')) {
                    var optionShippingtmp = $('body').find('input[name$="customer_pick_at_location"]:checked').val();
                    if (optionShippingtmp != '' && optionShippingtmp != undefined) listparameters.set('customer_pick_at_location', optionShippingtmp);

                } else {
                    listparameters.append("customer_pick_at_location", false);
                }


                if (formId == 'form_next_step' || formId == 'form_update_shipping_method' || formId == 'section-payment-method' || formId == 'section-shipping-rate') {
                    var version = Number($('body').find('.checkout_version').attr("data_checkout_version"));
                    if (version)
                        listparameters.append("version", version);
                }

                inputurl = listparameters.toString();

            } catch (err) {

                // Older Browser URLSearchParams not support
                var listparameters = parseQueryString($(formData).serialize());
                if (formId == 'form_next_step') {
                    var version = Number($('body').find('.checkout_version').attr("data_checkout_version"));
                    listparameters.version = version;
                }
                var countrytmp = $('body').find('input[name$="selected_customer_shipping_country"]').val();
                if (countrytmp != '') {
                    listparameters.customer_shipping_country = countrytmp;
                }

                var provincetmp = $('body').find('input[name$="selected_customer_shipping_province"]').val();
                if (provincetmp != '' && listparameters.customer_shipping_province) listparameters.customer_shipping_province = provincetmp;

                var districttmp = $('body').find('input[name$="selected_customer_shipping_district"]').val();
                if (districttmp != '' && listparameters.customer_shipping_district) listparameters.customer_shipping_district = districttmp;

                var wardtmp = $('body').find('input[name$="selected_customer_shipping_ward"]').val();
                if (wardtmp != '' && listparameters.customer_shipping_ward) listparameters.customer_shipping_ward = wardtmp;


                var address1tmp = $('body').find('input[name$="billing_address[address1]"]').val();
                if (address1tmp != '' && listparameters.billing_address[address1] && address1tmp != undefined) listparameters.set('billing_address[address1]', address1tmp);

                var phonetmp = $('body').find('input[name$="billing_address[phone]"]').val();
                if (phonetmp != '' && listparameters.billing_address[phone] && phonetmp != undefined) listparameters.set('billing_address[phone]', phonetmp);

                var emailtmp = $('body').find('input[name$="checkout_user[email]"]').val();
                if (emailtmp != '' && listparameters.checkout_user[email] && emailtmp != undefined) listparameters.set('checkout_user[email]', emailtmp);


                var fullnametmp = $('body').find('input[name$="billing_address[full_name]"]').val();
                if (fullnametmp != '' && listparameters.billing_address[full_name] && fullnametmp != undefined) listparameters.set('billing_address[full_name]', fullnametmp);


                delete listparameters.selected_customer_shipping_country;
                delete listparameters.selected_customer_shipping_province;
                delete listparameters.selected_customer_shipping_district;
                delete listparameters.selected_customer_shipping_ward;

                if ($('body').find('input[name$="customer_pick_at_location"]')) {
                    var optionShippingtmp = $('body').find('input[name$="customer_pick_at_location"]:checked').val();
                    if (optionShippingtmp != '' && optionShippingtmp != undefined) listparameters.set('customer_pick_at_location', optionShippingtmp);
                } else {
                    listparameters.append("customer_pick_at_location", false);
                }

                if (formId == 'form_next_step' || formId == 'form_update_shipping_method' || formId == 'section-payment-method' || formId == 'section-shipping-rate') {
                    var fiversion = $('body').find('.checkout_version').attr("data_checkout_version");
                    if (fiversion && fiversion != '') {
                        listparameters['version'] = Number(fiversion);
                    }

                }


                var listObject = '';
                for (var key in listparameters) {
                    listObject += '&' + key + '=' + encodeURIComponent(listparameters[key]);
                };
                inputurl = listObject.substring(1);

            }
            let url = window.location.origin + window.location.pathname + '?' + inputurl + encodeURI('&form_name=' + formId)
            $.ajax({
                type: 'GET',
                url,
                success: function(html) {
                    if ($(html).attr('id') == 'redirect-url') {
                        window.location = $(html).val();
                    } else {
                        if (replaceElement.length > 0) {
                            for (var i = 0; i < replaceElement.length; i++) {
                                var tempElement = replaceElement[i];
                                var newElement = $(html).find(tempElement);

                                if (newElement.length > 0) {
                                    if (tempElement == '.step-sections')
                                        $(tempElement).attr('step', $(newElement).attr('step'));

                                    var listTempElement = $(tempElement);

                                    for (var j = 0; j < newElement.length; j++)
                                        if (j < listTempElement.length) {

                                            if ($(newElement[j]).attr('id') == 'checkout_order_information_changed_error_message') {
                                                if ($(newElement[j]).find('span').html() != '') {
                                                    $(listTempElement[j]).removeClass('hidden');
                                                    $("html, body").animate({
                                                        scrollTop: 0
                                                    }, "slow");
                                                    if ($(window).width() <= 999) {
                                                        $('.banner').addClass('error');
                                                    }
                                                } else {
                                                    $(listTempElement[j]).addClass('hidden');
                                                    if ($(window).width() <= 999) {
                                                        $('.banner').removeClass('error');
                                                    }
                                                }
                                            }
                                            if ($(newElement[j]).attr('class') == 'order-summary-sections' && formId == 'section-payment-method') {
                                                const oldVersion = $('.checkout_version')
                                                const newVersion = $(html).find('.checkout_version').attr('data_checkout_version')
                                                $(oldVersion).attr('data_checkout_version', newVersion);
                                            } else {
                                                $(listTempElement[j]).html($(newElement[j]).html());
                                            }

                                        }
                                }
                            }
                        }





                        $("#div_location_country_not_vietnam").hide();
                        var is_vietnam_location = $("#is_vietnam_location").val();
                        if (is_vietnam_location && is_vietnam_location == "true") {
                            $("#div_location_country_not_vietnam").hide();
                        } else {
                            $("#div_location_country_not_vietnam").show();
                        }


                        $('body').attr('src', $(html).attr('src'));
                        $(element).find('button:submit').removeClass('btn-loading');

                        if (($('body').find('.field-error') && $('body').find('.field-error').length > 0) ||
                            ($('body').find('.has-error') && $('body').find('.has-error').length > 0)) {
                            $("html, body").animate({
                                scrollTop: 0
                            }, "slow");
                        }
                        if (['section-payment-method', 'form_discount_add', 'section-shipping-rate', 'form_discount_remove'].includes(formId) && isReePay) {
                            if (formId != 'section-payment-method') {
                                paylayterLoadingTrigger()
                                funcFormOnSubmit('#section-payment-method')
                            } else {
                                if (findPaymentMethodId == 41) {
                                    $('#section-pay-later-method').removeClass('hidden')
                                }
                                if (findPaymentMethodId == 43) {
                                    $('#section-pay-later-method-kredivo').removeClass('hidden')
                                }
                                paylayterLoadingTrigger(false)
                            }
                        } else {
                            paylayterLoadingTrigger()
                        }

                        if (formId == 'form_update_location_customer_shipping' || formId == 'form_update_shipping_method') {
                            if ($('.order-checkout__loading--box').length > 0) {
                                $('.order-checkout__loading--box').removeClass('show');
                            }
                        }
                        if (funcCallback)
                            funcCallback();
                    }
                }
            }).fail(function() {
                $(element).find('button:submit').removeClass('btn-loading');
                if (formId == 'section-payment-method') {
                    $('#section-pay-later-method').addClass('hidden');
                    paylayterLoadingTrigger(false)
                }
                if (formId == 'form_update_location_customer_shipping' || formId == 'form_update_shipping_method') {
                    if ($('.order-checkout__loading--box').length > 0) {
                        $('.order-checkout__loading--box').removeClass('show');
                    }
                }
            });

            return false;
        };

        function getRepayment(e) {
            let element, formData;
            if (typeof(e) == 'string') {
                element = $(e);
            } else {
                element = this;
                e.preventDefault();
            }
            const findPaymentMethodId = $('body').find('input:radio[name$="payment_method_id"]:checked').attr('type-id');

            const isReePay = findPaymentMethodId == 41 || findPaymentMethodId == 43

            var formId = $(element).attr('id'),
                replaceElement = [],
                funcCallback;
            if (formId == undefined || formId == null || formId == '') return;
            if (isReePay) {
                if (findPaymentMethodId == 41) {
                    $('#section-pay-later-method-kredivo').addClass('hidden');
                    $('#section-pay-later-method').removeClass('hidden');
                }
                if (findPaymentMethodId == 43) {
                    $('#section-pay-later-method').addClass('hidden');
                    $('#section-pay-later-method-kredivo').removeClass('hidden');
                }
                paylayterLoadingTrigger()
            }
            replaceElement.push('.content-box');
            replaceElement.push('#section-pay-later-method');
            replaceElement.push('#section-pay-later-method-kredivo')

            let paymentMethodId = $('body').find('input:radio[name$="payment_method_id"]:checked').val()
            if (formId == 'section-payment-method') {
                $.ajax({
                    type: 'GET',
                    url: window.location.origin + window.location.pathname + '?' + 'payment_method_id=' + paymentMethodId + '&preview=true',
                    success: function(html) {
                        for (var i = 0; i < replaceElement.length; i++) {
                            let tempElement = replaceElement[i];
                            let newElement = $(html).find(tempElement);
                            if (newElement.length > 0) {

                                let listTempElement = $(tempElement);
                                for (var j = 0; j < newElement.length; j++)
                                    if (j < listTempElement.length) {
                                        $(listTempElement[j]).html($(newElement[j]).html());
                                    }
                            }
                        }
                        if (isReePay) {
                            if (findPaymentMethodId == 41) {
                                $('#section-pay-later-method').removeClass('hidden');
                            }
                            if (findPaymentMethodId == 43) {
                                $('#section-pay-later-method-kredivo').removeClass('hidden');
                            }
                        };
                        paylayterLoadingTrigger(false)
                    }
                }).fail(function() {
                    $('#section-pay-later-method').addClass('hidden');
                    $('#section-pay-later-method-kredivo').addClass('hidden');
                    $('.checkout-payment__loading--box').removeClass('show');
                    $('.payment-later-table--loading').removeClass('show');
                })
            }
            return false;
        }

        function funcSetEvent() {

            var effectControlFieldClass = '.field input, .field select, .field textarea';
            $('body')
                .on('focus', effectControlFieldClass, function() {
                    funcFieldFocus($(this), true);
                })
                .on('blur', effectControlFieldClass, function() {
                    funcFieldFocus($(this), false);
                    funcFieldHasValue($(this), true);
                })
                .on('keyup input paste', effectControlFieldClass, function() {
                    funcFieldHasValue($(this), false);
                })
                .on('submit', 'form', funcFormOnSubmit);






            $("#div_location_country_not_vietnam").hide();
            $("#is_vietnam_location").val("true");
            $("#div_location_country_not_vietnam").hide();




            $('body')
                .on('change', '#form_update_location_customer_shipping input[id=billing_address_city]', function() {
                    $('#form_update_location_customer_shipping input[id=billing_address_city]').val($(this).val());
                    return false;
                })
                .on('change', '#form_update_location_customer_shipping input[id=billing_address_zip]', function() {
                    $('#form_update_location_customer_shipping input[id=billing_address_zip]').val($(this).val());
                    return false;
                })
                .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_country]', function() {

                    var country_selected = $('body').find('input[name=selected_customer_shipping_country]');
                    if (country_selected && country_selected.length > 0) {
                        $(country_selected).val($(this).val());
                        var province_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_province]');
                        if (province_selected && province_selected.length > 0) {
                            province_selected.val("null");
                        }
                        var district_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_district]');
                        if (district_selected && district_selected.length > 0) {
                            district_selected.val("null");
                        }

                        var ward_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_ward]');
                        if (ward_selected && ward_selected.length > 0) {
                            ward_selected.val("null");
                        }
                    }
                    $('.section-customer-information input:hidden[name=customer_shipping_country]').val($(this).val());
                })
                .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_province]', function() {

                    var province_selected = $('body').find('input[name=selected_customer_shipping_province]');
                    if (province_selected && province_selected.length > 0) {
                        $(province_selected).val($(this).val());
                        var district_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_district]');
                        if (district_selected && district_selected.length > 0) {
                            district_selected.val("null");
                        }


                        var ward_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_ward]');
                        if (ward_selected && ward_selected.length > 0) {
                            ward_selected.val("null");
                        }
                    }
                    $('.section-customer-information input:hidden[name=customer_shipping_province]').val($(this).val());

                })
                .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_district]', function() {

                    var district_selected = $('body').find('input[name=selected_customer_shipping_district]');
                    if (district_selected && district_selected.length > 0) {
                        var ward_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_ward]');
                        if (ward_selected && ward_selected.length > 0) {
                            ward_selected.val("null");
                        }
                    }
                    $('.section-customer-information input:hidden[name=customer_shipping_district]').val($(this).val());
                })
                .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_ward]', function() {

                    var ward_selected = $('body').find('input[name=selected_customer_shipping_ward]');
                    if (ward_selected && ward_selected.length > 0) {
                        $(ward_selected).val($(this).val());
                    }
                    $('.section-customer-information input:hidden[name=customer_shipping_ward]').val($(this).val());
                })
                .on('change', '#form_update_location_customer_shipping', function(e) {
                    if (e.target.id === 'billing_address_address1') return;
                    funcFormOnSubmit('#form_update_location_customer_shipping');
                })
                .on('change', '#form_update_location_customer_pick_at_location', function() {
                    funcFormOnSubmit('#form_update_location_customer_pick_at_location');
                });


            $('body')

            .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_country]', function() {

                    var country_selected = $('body').find('input[name=selected_customer_shipping_country]');
                    if (country_selected && country_selected.length > 0) {
                        $(country_selected).val($(this).val());

                        var province_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_province]');
                        if (province_selected && province_selected.length > 0) {
                            province_selected.val("null");
                        }
                        var district_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_district]');
                        if (district_selected && district_selected.length > 0) {
                            district_selected.val("null");
                        }

                        var ward_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_ward]');
                        if (ward_selected && ward_selected.length > 0) {
                            ward_selected.val("null");
                        }

                        var province = $('.section-customer-information input:hidden[name=customer_shipping_province]');
                        if (province) {
                            province.val("null");
                        }

                        var district = $('.section-customer-information input:hidden[name=customer_shipping_district]');
                        if (district) {
                            district.val("null");
                        }
                        var ward = $('.section-customer-information input:hidden[name=customer_shipping_ward]');
                        if (ward) {
                            ward.val("null");
                        }
                    }

                    $('.section-customer-information input:hidden[name=customer_shipping_coutry]').val($(this).val());
                })
                .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_province]', function() {

                    var province_selected = $('body').find('input[name=selected_customer_shipping_province]');
                    if (province_selected && province_selected.length > 0) {
                        $(province_selected).val($(this).val());
                        var district_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_district]');
                        if (district_selected && district_selected.length > 0) {
                            district_selected.val("null");
                        }

                        var ward_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_ward]');
                        if (ward_selected && ward_selected.length > 0) {
                            ward_selected.val("null");
                        }

                        var district = $('.section-customer-information input:hidden[name=customer_shipping_district]');
                        if (district) {
                            district.val("null");
                        }
                        var ward = $('.section-customer-information input:hidden[name=customer_shipping_ward]');
                        if (ward) {
                            ward.val("null");
                        }
                    }
                    $('.section-customer-information input:hidden[name=customer_shipping_province]').val($(this).val());
                })
                .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_district]', function() {

                    var district_selected = $('body').find('input[name=selected_customer_shipping_district]');
                    if (district_selected && district_selected.length > 0) {
                        $(district_selected).val($(this).val());

                        var ward_selected = $('body').find('#form_update_location_customer_shipping select[name=customer_shipping_ward]');
                        if (ward_selected && ward_selected.length > 0) {
                            ward_selected.val("null");
                        }
                        var ward = $('.section-customer-information input:hidden[name=customer_shipping_ward]');
                        if (ward) {
                            ward.val("null");
                        }
                    }
                    $('.section-customer-information input:hidden[name=customer_shipping_district]').val($(this).val());
                })
                .on('change', '#form_update_location_customer_shipping select[name=customer_shipping_ward]', function() {


                    var ward_selected = $('body').find('input[name=selected_customer_shipping_ward]');
                    if (ward_selected && ward_selected.length > 0) {
                        $(ward_selected).val($(this).val());
                    }

                    $('.section-customer-information input:hidden[name=customer_shipping_ward]').val($(this).val());
                });



            $('body')
                .on('change', '#form_update_shipping_method input:radio', function(e) {
                    $('#form_update_shipping_method .content-box-row.content-box-row-secondary').addClass('hidden');

                    var id = $(this).attr('id');

                    if (id) {
                        var sub = $('body').find('.content-box-row.content-box-row-secondary[for=' + id + ']')

                        if (sub && sub.length > 0) {
                            $(sub).removeClass('hidden');
                        }
                    }
                });



            $('body')
                .on('change', '#section-payment-method input:radio', function() {
                    $('#section-payment-method .content-box-row.content-box-row-secondary').addClass('hidden');

                    var id = $(this).attr('id');

                    if (id) {
                        var sub = $('body').find('.content-box-row.content-box-row-secondary[for=' + id + ']')

                        if (sub && sub.length > 0) {
                            $(sub).removeClass('hidden');
                        }
                    }
                });



            $('body')
                .on('change', '#section-shipping-rate input:radio[name=shipping_rate_id]', function() {
                    funcFormOnSubmit('#section-shipping-rate');
                })
                .on('change', '#section-payment-method  input:radio[name=payment_method_id]', function() {
                    funcFormOnSubmit('#section-payment-method');
                });








            $('body')
                .on('change', '#form_update_shipping_method select[name=customer_shipping_country]', function() {
                    var currentCountry = $(this).val();
                    if (currentCountry && currentCountry != "null" && currentCountry != 241) {

                        $("#is_vietnam_location").val("false");
                        $("#div_location_country_not_vietnam").show();
                    } else {

                        $("#is_vietnam_location").val("true");
                        $("#div_location_country_not_vietnam").hide();
                    }
                })
                .on('change', '#form_update_shipping_method input:radio[name=customer_pick_at_location]', function() {
                    var methodValue = $(this).val();

                    if (methodValue && methodValue == 'false')
                        $('.inventory_location').hide();
                    else
                        $('.inventory_location').show();
                    $('#form_update_shipping_method').submit();
                })
                .on('change', '.inventory_location input:radio[name=inventory_location_id]', function() {
                    $('.section-customer-information input:hidden[name=inventory_location_id]').val($(this).val());
                });


        };

        function funcFieldFocus(fieldInputElement, isFocus) {

            if (fieldInputElement == undefined)
                return;

            var fieldElement = $(fieldInputElement).closest('.field');

            if (fieldElement == undefined)
                return;

            if (isFocus)
                $(fieldElement).addClass('field-active');
            else
                $(fieldElement).removeClass('field-active');
        };

        function funcFieldHasValue(fieldInputElement, isCheckRemove) {

            if (fieldInputElement == undefined)
                return;

            var fieldElement = $(fieldInputElement).closest('.field');

            if (fieldElement == undefined)
                return;

            if ($(fieldElement).find('.field-input-wrapper-select').length > 0) {
                var value = $(fieldInputElement).find(':selected').val();

                if (value == 'null')
                    value = undefined;

                if ($(fieldInputElement)[0].id == 'customer_shipping_country') {
                    var country_selected = $('body').find('input[name=selected_customer_shipping_country]');
                    if (country_selected && country_selected.length > 0) {
                        $(country_selected).val(value);
                    }
                }

                if ($(fieldInputElement)[0].id == 'customer_shipping_province') {
                    var province_selected = $('body').find('input[name=selected_customer_shipping_province]');
                    if (province_selected && province_selected.length > 0) {
                        $(province_selected).val(value);
                    }
                }

                if ($(fieldInputElement)[0].id == 'customer_shipping_district') {
                    var district_selected = $('body').find('input[name=selected_customer_shipping_district]');
                    if (district_selected && district_selected.length > 0) {
                        $(district_selected).val(value);
                    }
                }
                if ($(fieldInputElement)[0].id == 'customer_shipping_ward') {
                    var ward_selected = $('body').find('input[name=selected_customer_shipping_ward]');
                    if (ward_selected && ward_selected.length > 0) {
                        $(ward_selected).val(value);
                    }
                }

            } else {
                var value = $(fieldInputElement).val();
            }

            if (!isCheckRemove) {
                if (value != $(fieldInputElement).attr('value'))
                    $(fieldElement).removeClass('field-error');
            }

            var fieldInputBtnWrapperElement = $(fieldInputElement).closest('.field-input-btn-wrapper');

            if (value && value.trim() != '') {
                $(fieldElement).addClass('field-show-floating-label');
                $(fieldInputBtnWrapperElement).find('button:submit').removeClass('btn-disabled');
            } else if (isCheckRemove) {
                $(fieldElement).removeClass('field-show-floating-label');
                $(fieldInputBtnWrapperElement).find('button:submit').addClass('btn-disabled');
            } else {
                $(fieldInputBtnWrapperElement).find('button:submit').addClass('btn-disabled');
            }
        };

        function funcInit() {

            funcSetEvent();


        }

        function funcReplaceMembershipInfo(html, replaceElement) {

            var tempElement = $(replaceElement);
            var newElement = $(html).find(replaceElement);
            tempElement.html(newElement.html());
        }

        function funcMembershipInfo() {

        }

        function funcGetBrowserInfo() {

            $.ajax({
                type: 'POST',
                url: '/browser-info?w=' + $(window).width() + '&h=' + $(window).height(),
                success: function() {}
            });


        }
        $(document).ready(function() {
            funcInit();
            funcMembershipInfo();
            funcGetBrowserInfo();
        });
    </script>


    <script type="text/javascript">
        var toggleShowOrderSummary = false;
        $(document).ready(function() {
            var currentUrl = '';
            const findPaymentMethodId = $('body').find('input:radio[name$="payment_method_id"]:checked').attr('type-id');
            const isReePay = findPaymentMethodId == 41 || findPaymentMethodId == 43
            if (isReePay) {

                funcFormOnSubmit('#section-payment-method')

            }

            currentUrl = '/checkouts/9379a365d24e4fccba2453af2bd95dc9?step=1';


            if ($('#reloadValue').val().length == 0) {
                $('#reloadValue').val(currentUrl);
                $('body').show();
            } else {
                window.location = $('#reloadValue').val();
                $('#reloadValue').val('');
            }

            $('body')
                .on('click', '.order-summary-toggle', function() {
                    toggleShowOrderSummary = !toggleShowOrderSummary;

                    if (toggleShowOrderSummary) {
                        $('.order-summary-toggle')
                            .removeClass('order-summary-toggle-hide')
                            .addClass('order-summary-toggle-show');

                        $('.sidebar:not(".sidebar-second") .sidebar-content .order-summary')
                            .removeClass('order-summary-is-collapsed')
                            .addClass('order-summary-is-expanded');

                        $('.sidebar.sidebar-second .sidebar-content .order-summary')
                            .removeClass('order-summary-is-expanded')
                            .addClass('order-summary-is-collapsed');
                    } else {
                        $('.order-summary-toggle')
                            .removeClass('order-summary-toggle-show')
                            .addClass('order-summary-toggle-hide');

                        $('.sidebar:not(".sidebar-second") .sidebar-content .order-summary')
                            .removeClass('order-summary-is-expanded')
                            .addClass('order-summary-is-collapsed');

                        $('.sidebar.sidebar-second .sidebar-content .order-summary')
                            .removeClass('order-summary-is-collapsed')
                            .addClass('order-summary-is-expanded');
                    }
                });
        });
    </script>

    <script type='text/javascript'>
        //<![CDATA[
        if ((typeof Haravan) === 'undefined') {
            Haravan = {};
        }
        Haravan.culture = 'vi-VN';
        Haravan.shop = 'adamgroup.myharavan.com';
        Haravan.theme = {
            "name": "Optimize [1pixel] Do not delete this theme",
            "id": 1000835503,
            "role": "main"
        };
        Haravan.domain = 'adamstorevn.com';
        //]]>
    </script>
    <!-- Global site tag (gtag.js) - Google Ads: 762113636 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-762113636"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-762113636');
    </script>
    <meta name="google-site-verification" content="ubN6YPDReVk-WJtNRDQCu6kZseP5wKcKcOhyTxpKdDQ" />
    <script type='text/javascript'>
        ! function() {
            var hrv_analytics = window.hrv_analytics = window.hrv_analytics || [];
            if (!hrv_analytics.initialize)
                if (hrv_analytics.invoked) window.console && console.error && console.error("Segment snippet included twice.");
                else {
                    hrv_analytics.invoked = !0;
                    hrv_analytics.methods = ["start", "trackSubmit", "trackClick", "trackLink", "trackForm", "pageview", "identify", "reset", "group", "track", "ready", "alias", "debug", "page", "once", "off", "on"];
                    hrv_analytics.factory = function(t) {
                        return function() {
                            var e = Array.prototype.slice.call(arguments);
                            e.unshift(t);
                            hrv_analytics.push(e);
                            return hrv_analytics
                        }
                    };
                    for (var t = 0; t < hrv_analytics.methods.length; t++) {
                        var e = hrv_analytics.methods[t];
                        hrv_analytics[e] = hrv_analytics.factory(e)
                    }
                    hrv_analytics.load = function(t, e) {
                        var n = document.createElement("script");
                        n.type = "text/javascript";
                        n.async = !0;
                        n.src = "https://stats.hstatic.net/analytics.min.js?t=15";
                        var a = document.getElementsByTagName("script")[0];
                        a.parentNode.insertBefore(n, a);
                        hrv_analytics._loadOptions = e
                    };
                    hrv_analytics.SNIPPET_VERSION = "4.1.0";
                    hrv_analytics.start('pro:web:1000333436');
                    hrv_analytics.page();
                    hrv_analytics.load();
                }
        }();
    </script>
    <style>
        .grecaptcha-badge {
            visibility: hidden;
        }
    </style>
    <script type='text/javascript'>
        window.HaravanAnalytics = window.HaravanAnalytics || {};
        window.HaravanAnalytics.meta = window.HaravanAnalytics.meta || {};
        window.HaravanAnalytics.meta.currency = 'VND';
        var meta = {
            "page": {
                "pageType": "checkout",
                "resourceType": "checkout",
                "resourceId": "9379a365d24e4fccba2453af2bd95dc9"
            },
            "cart": {
                "products": [{
                    "variantId": 1081543075,
                    "productId": 1037376957,
                    "price": 295000000.0,
                    "name": "Áo vest xanh ghi xước - AV287 - 48",
                    "sku": "AV28748",
                    "vendor": "Khác",
                    "variant": "48",
                    "type": "VEST ADAM",
                    "quantity": 1
                }],
                "item_count": 1,
                "total_price": 295000000.0
            }
        };
        for (var attr in meta) {
            window.HaravanAnalytics.meta[attr] = meta[attr];
        }
        window.HaravanAnalytics.AutoTrack = true;
    </script>
    <script>
        //<![CDATA[
        window.HaravanAnalytics.ga = "UA-84504140-1";
        window.HaravanAnalytics.enhancedEcommerce = true;
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', window.HaravanAnalytics.ga, {
            cookieDomain: 'auto',
            siteSpeedSampleRate: '10',
            sampleRate: 100,
            allowLinker: true
        });
        ga('send', 'pageview');
        ga('require', 'linker');
        ga('require', 'linker');
        try {
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-WWQF2PM');
        } catch (e) {};
        //]]>
    </script>
    <script>
        window.HaravanAnalytics.fb = "1170220843066660";
        //<![CDATA[
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', '//connect.facebook.net/en_US/fbevents.js');
        // Insert Your Facebook Pixel ID below. 
        fbq('init', window.HaravanAnalytics.fb, {}, {
            'agent': 'plharavan'
        });
        fbq('track', 'PageView');
        //]]>
    </script>
    <noscript><img height='1' width='1' style='display:none'
            src='https://www.facebook.com/tr?id=1170220843066660&amp;ev=PageView&amp;noscript=1' /></noscript>
    <!-- Event snippet for PAGE_VIEW-1000333436-02/18/2019 13:29:10 conversion page -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-762113636/YwO0CP3ksJUBEOTcs-sC'
        });
    </script>

</head>

<body>


    <input id="reloadValue" type="hidden" name="reloadValue" value="" />
    <input id="is_vietnam" type="hidden" value="true" />
    <input id="is_vietnam_location" type="hidden" value="true" />

    <div class="banner">
        <div class="wrap">
            <a href="/" class="logo">


                <h1 class="logo-text">ADAM STORE - Thương hiệu veston may sẵn hàng đầu Việt Nam</h1>

            </a>
        </div>
    </div>

    <button class="order-summary-toggle order-summary-toggle-hide">
        <div class="wrap">
            <div class="order-summary-toggle-inner">
                <div class="order-summary-toggle-icon-wrapper">
                    <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-icon">
                        <path
                            d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z">
                        </path>
                    </svg>
                </div>
                <div class="order-summary-toggle-text order-summary-toggle-text-show">
                    <span>Hiển thị thông tin đơn hàng</span>
                    <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-dropdown"
                        fill="#000">
                        <path
                            d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z">
                        </path>
                    </svg>
                </div>
                <div class="order-summary-toggle-text order-summary-toggle-text-hide">
                    <span>Ẩn thông tin đơn hàng</span>
                    <svg width="11" height="7" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle-dropdown"
                        fill="#000">
                        <path
                            d="M6.138.876L5.642.438l-.496.438L.504 4.972l.992 1.124L6.138 2l-.496.436 3.862 3.408.992-1.122L6.138.876z">
                        </path>
                    </svg>
                </div>
                <div class="order-summary-toggle-total-recap" data-checkout-payment-due-target="295000000">
                    <span class="total-recap-final-price">2,950,000₫</span>
                </div>
            </div>
        </div>
    </button>
    <div class="content content-second">
        <div class="wrap">
            <div class="sidebar sidebar-second">
                <div class="sidebar-content">
                    <div class="order-summary">
                        <div class="order-summary-sections">


                            <div class="order-summary-section order-summary-section-discount" data-order-summary-section="discount">
                                <form id="form_discount_add" accept-charset="UTF-8" method="post">
                                    <input name="utf8" type="hidden" value="✓">

                                    <div class="fieldset">
                                        <div class="field  ">
                                            <div class="field-input-btn-wrapper">
                                                <div class="field-input-wrapper">
                                                    <label class="field-label" for="discount.code">Mã giảm giá</label>
                                                    <input placeholder="Mã giảm giá" class="field-input" data-discount-field="true" autocomplete="false" autocapitalize="off" spellcheck="false" size="30" type="text" id="discount.code" name="discount.code" value="" />
                                                </div>
                                                <button type="submit" class="field-input-btn btn btn-default btn-disabled">
                                                    <span class="btn-content">Sử dụng</span>
                                                    <i class="btn-spinner icon icon-button-spinner"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">

        <div class="wrap">
            <div class="sidebar">
                <div class="sidebar-content">
                    <div class="order-summary order-summary-is-collapsed">
                        <h2 class="visually-hidden">Thông tin đơn hàng</h2>
                        <div class="order-summary-sections">
                            <div class="order-summary-section order-summary-section-product-list" data-order-summary-section="line-items">
                                <table class="product-table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><span class="visually-hidden">Hình ảnh</span></th>
                                            <th scope="col"><span class="visually-hidden">Mô tả</span></th>
                                            <th scope="col"><span class="visually-hidden">Số lượng</span></th>
                                            <th scope="col"><span class="visually-hidden">Giá</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="product" data-product-id="1037376957" data-variant-id="1081543075">
                                            <td class="product-image">
                                                <div class="product-thumbnail">
                                                    <div class="product-thumbnail-wrapper">
                                                        <img class="product-thumbnail-image" alt="Áo vest xanh ghi xước - AV287" src="//product.hstatic.net/1000333436/product/_ntt6350_29795595bb664525ba50ed0b77e3856c_small.jpg" />
                                                    </div>
                                                    <span class="product-thumbnail-quantity" aria-hidden="true">1</span>
                                                </div>
                                            </td>
                                            <td class="product-description">
                                                <span class="product-description-name order-summary-emphasis">Áo vest
                                                    xanh ghi xước - AV287</span>

                                                <span class="product-description-variant order-summary-small-text">
                                                    48
                                                </span>

                                            </td>
                                            <td class="product-quantity visually-hidden">1</td>
                                            <td class="product-price">
                                                <span class="order-summary-emphasis">2,950,000₫</span>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="order-summary-section order-summary-section-discount" data-order-summary-section="discount">
                                <form id="form_discount_add" accept-charset="UTF-8" method="post">
                                    <input name="utf8" type="hidden" value="✓">
                                    <div class="fieldset">
                                        <div class="field  ">
                                            <div class="field-input-btn-wrapper">
                                                <div class="field-input-wrapper">
                                                    <label class="field-label" for="discount.code">Mã giảm giá</label>
                                                    <input placeholder="Mã giảm giá" class="field-input" data-discount-field="true" autocomplete="false" autocapitalize="off" spellcheck="false" size="30" type="text" id="discount.code" name="discount.code" value="" />
                                                </div>
                                                <button type="submit" class="field-input-btn btn btn-default btn-disabled">
                                                    <span class="btn-content">Sử dụng</span>
                                                    <i class="btn-spinner icon icon-button-spinner"></i>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="order-summary-section order-summary-section-total-lines payment-lines" data-order-summary-section="payment-lines">
                                <table class="total-line-table">
                                    <thead>
                                        <tr>
                                            <th scope="col"><span class="visually-hidden">Mô tả</span></th>
                                            <th scope="col"><span class="visually-hidden">Giá</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="total-line total-line-subtotal">
                                            <td class="total-line-name">Tạm tính</td>
                                            <td class="total-line-price">
                                                <span class="order-summary-emphasis" data-checkout-subtotal-price-target="295000000">
                                                    2,950,000₫
                                                </span>
                                            </td>
                                        </tr>


                                        <tr class="total-line total-line-shipping">
                                            <td class="total-line-name">Phí ship</td>
                                            <td class="total-line-price">
                                                <span class="order-summary-emphasis" data-checkout-total-shipping-target="0">

                                                    —

                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="total-line-table-footer">
                                        <tr class="total-line">
                                            <td class="total-line-name payment-due-label">
                                                <span class="payment-due-label-total">Tổng tiền</span>
                                            </td>
                                            <td class="total-line-name payment-due">
                                                <span class="payment-due-currency">VND</span>
                                                <span class="payment-due-price" data-checkout-payment-due-target="295000000">
                                                    2,950,000₫
                                                </span>
                                                <span class="checkout_version" display:none data_checkout_version="18">
                                                </span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="main-header">

                    <a href="/" class="logo">

                        <h1 class="logo-text">ADAM STORE - Thương hiệu veston may sẵn hàng đầu Việt Nam</h1>

                    </a>

                    <style>
                        a.logo {
                            display: block;
                        }
                        
                        .logo-cus {
                            width: 100%;
                            padding: 15px 0;
                            text-align: 0;
                        }
                        
                        .logo-cus img {
                            max-height: 4.2857142857em
                        }
                        
                        .logo-text {
                            text-align: 0;
                        }
                        
                        @media (max-width: 767px) {
                            .banner a {
                                display: block;
                            }
                        }
                    </style>


                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/cart">Giỏ hàng</a>
                        </li>

                        <li class="breadcrumb-item breadcrumb-item-current">
                            Thông tin vận chuyển
                        </li>

                    </ul>

                </div>
                <div class="main-content">


                    <div id="checkout_order_information_changed_error_message" class="hidden" style="margin-bottom:15px">



                        <p class="field-message field-message-error alert alert-danger"><svg x="0px" y="0px" viewBox="0 0 286.054 286.054" style="enable-background:new 0 0 286.054 286.054;" xml:space="preserve">
                                <g>
                                    <path style="fill:#E2574C;"
                                        d="M143.027,0C64.04,0,0,64.04,0,143.027c0,78.996,64.04,143.027,143.027,143.027 c78.996,0,143.027-64.022,143.027-143.027C286.054,64.04,222.022,0,143.027,0z M143.027,259.236 c-64.183,0-116.209-52.026-116.209-116.209S78.844,26.818,143.027,26.818s116.209,52.026,116.209,116.209 S207.21,259.236,143.027,259.236z M143.036,62.726c-10.244,0-17.995,5.346-17.995,13.981v79.201c0,8.644,7.75,13.972,17.995,13.972 c9.994,0,17.995-5.551,17.995-13.972V76.707C161.03,68.277,153.03,62.726,143.036,62.726z M143.036,187.723 c-9.842,0-17.852,8.01-17.852,17.86c0,9.833,8.01,17.843,17.852,17.843s17.843-8.01,17.843-17.843 C160.878,195.732,152.878,187.723,143.036,187.723z" />
                                </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                                <g> </g>
                            </svg> <span></span></p>
                    </div>
                    <script>
                        $("html, body").animate({
                            scrollTop: 0
                        }, "slow");
                    </script>


                    <div class="step">

                        <div class="step-sections steps-onepage" step="1">



                            <div class="section">
                                <div class="section-header">
                                    <h2 class="section-title">Thông tin thanh toán</h2>
                                </div>
                                <div class="section-content section-customer-information ">


                                    <p class="section-content-text">
                                        Bạn đã có tài khoản?
                                        <a href="/account/login?urlredirect=%2Fcheckouts%2F9379a365d24e4fccba2453af2bd95dc9%3Fstep%3D1">Đăng
                                            nhập</a>
                                    </p>


                                    <div class="fieldset">


                                        <div class="field field-required  ">
                                            <div class="field-input-wrapper">
                                                <label class="field-label" for="billing_address_full_name">Họ và
                                                    tên</label>
                                                <input placeholder="Họ và tên" autocapitalize="off" spellcheck="false" class="field-input" size="30" type="text" id="billing_address_full_name" name="billing_address[full_name]" value="" autocomplete="false" />
                                            </div>

                                        </div>



                                        <div class="field field-required field-two-thirds  ">
                                            <div class="field-input-wrapper">
                                                <label class="field-label" for="checkout_user_email">Email</label>
                                                <input autocomplete="false" placeholder="Email" autocapitalize="off" spellcheck="false" class="field-input" size="30" type="email" id="checkout_user_email" name="checkout_user[email]" value="" />
                                            </div>

                                        </div>



                                        <div class="field field-required field-third  ">
                                            <div class="field-input-wrapper">
                                                <label class="field-label" for="billing_address_phone">Điện
                                                    thoại</label>
                                                <input autocomplete="false" placeholder="Điện thoại" autocapitalize="off" spellcheck="false" class="field-input" size="30" maxlength="15" type="tel" id="billing_address_phone" name="billing_address[phone]" value="" />
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <div class="section-content">
                                    <div class="fieldset">

                                        <form autocomplete="off" id="form_update_shipping_method" class="field " accept-charset="UTF-8" method="post">
                                            <input name="utf8" type="hidden" value="✓">
                                            <div class="content-box mt0">

                                                <div class="radio-wrapper content-box-row">
                                                    <label class="radio-label">
                                                        <div class="radio-input">
                                                            <input type="radio" id="customer_pick_at_location_false"
                                                                name="customer_pick_at_location" class="input-radio"
                                                                value="false" checked>
                                                        </div>
                                                        <span class="radio-label-primary">Giao hàng</span>
                                                    </label>
                                                </div>

                                                <div id="form_update_location_customer_shipping" class="order-checkout__loading radio-wrapper content-box-row content-box-row-padding content-box-row-secondary " for="customer_pick_at_location_false">
                                                    <input name="utf8" type="hidden" value="✓">
                                                    <div class="order-checkout__loading--box">
                                                        <div class="order-checkout__loading--circle"></div>
                                                    </div>

                                                    <div class="field   ">
                                                        <div class="field-input-wrapper">
                                                            <label class="field-label" for="billing_address_address1">Địa chỉ</label>
                                                            <input placeholder="Địa chỉ" autocapitalize="off" spellcheck="false" class="field-input" size="30" type="text" id="billing_address_address1" name="billing_address[address1]" value="" />
                                                        </div>

                                                    </div>



                                                    <input name="selected_customer_shipping_country" type="hidden" value="">
                                                    <input name="selected_customer_shipping_province" type="hidden" value="">
                                                    <input name="selected_customer_shipping_district" type="hidden" value="">
                                                    <input name="selected_customer_shipping_ward" type="hidden" value="">

                                                    <div class="field field-show-floating-label  field-third ">
                                                        <div class="field-input-wrapper field-input-wrapper-select">
                                                            <label class="field-label" for="customer_shipping_province">
                                                                Tỉnh </label>
                                                            <select class="field-input" id="customer_shipping_province" name="customer_shipping_province">
                                                                <option data-code="null" value="null" selected>

                                                                    Chọn tỉnh thành </option>



                                                                <option data-code="HC" value="50">Hồ Chí Minh</option>



                                                                <option data-code="HI" value="1">Hà Nội</option>



                                                                <option data-code="DA" value="32">Đà Nẵng</option>



                                                                <option data-code="AG" value="57">An Giang</option>



                                                                <option data-code="BV" value="49">Bà Rịa - Vũng Tàu
                                                                </option>



                                                                <option data-code="BI" value="47">Bình Dương</option>



                                                                <option data-code="BP" value="45">Bình Phước</option>



                                                                <option data-code="BU" value="39">Bình Thuận</option>



                                                                <option data-code="BD" value="35">Bình Định</option>



                                                                <option data-code="BL" value="62">Bạc Liêu</option>



                                                                <option data-code="BG" value="15">Bắc Giang</option>



                                                                <option data-code="BK" value="4">Bắc Kạn</option>



                                                                <option data-code="BN" value="18">Bắc Ninh</option>



                                                                <option data-code="BT" value="53">Bến Tre</option>



                                                                <option data-code="CB" value="3">Cao Bằng</option>



                                                                <option data-code="CM" value="63">Cà Mau</option>



                                                                <option data-code="CN" value="59">Cần Thơ</option>



                                                                <option data-code="GL" value="41">Gia Lai</option>



                                                                <option data-code="HG" value="2">Hà Giang</option>



                                                                <option data-code="HM" value="23">Hà Nam</option>



                                                                <option data-code="HT" value="28">Hà Tĩnh</option>



                                                                <option data-code="HO" value="11">Hòa Bình</option>



                                                                <option data-code="HY" value="21">Hưng Yên</option>



                                                                <option data-code="HD" value="19">Hải Dương</option>



                                                                <option data-code="HP" value="20">Hải Phòng</option>



                                                                <option data-code="HU" value="60">Hậu Giang</option>



                                                                <option data-code="KH" value="37">Khánh Hòa</option>



                                                                <option data-code="KG" value="58">Kiên Giang</option>



                                                                <option data-code="KT" value="40">Kon Tum</option>



                                                                <option data-code="LI" value="8">Lai Châu</option>



                                                                <option data-code="LA" value="51">Long An</option>



                                                                <option data-code="LO" value="6">Lào Cai</option>



                                                                <option data-code="LD" value="44">Lâm Đồng</option>



                                                                <option data-code="LS" value="13">Lạng Sơn</option>



                                                                <option data-code="ND" value="24">Nam Định</option>



                                                                <option data-code="NA" value="27">Nghệ An</option>



                                                                <option data-code="NB" value="25">Ninh Bình</option>



                                                                <option data-code="NT" value="38">Ninh Thuận</option>



                                                                <option data-code="PT" value="16">Phú Thọ</option>



                                                                <option data-code="PY" value="36">Phú Yên</option>



                                                                <option data-code="QB" value="29">Quảng Bình</option>



                                                                <option data-code="QM" value="33">Quảng Nam</option>



                                                                <option data-code="QG" value="34">Quảng Ngãi</option>



                                                                <option data-code="QN" value="14">Quảng Ninh</option>



                                                                <option data-code="QT" value="30">Quảng Trị</option>



                                                                <option data-code="ST" value="61">Sóc Trăng</option>



                                                                <option data-code="SL" value="9">Sơn La</option>



                                                                <option data-code="TH" value="26">Thanh Hóa</option>



                                                                <option data-code="TB" value="22">Thái Bình</option>



                                                                <option data-code="TY" value="12">Thái Nguyên</option>



                                                                <option data-code="TT" value="31">Thừa Thiên Huế
                                                                </option>



                                                                <option data-code="TG" value="52">Tiền Giang</option>



                                                                <option data-code="TV" value="54">Trà Vinh</option>



                                                                <option data-code="TQ" value="5">Tuyên Quang</option>



                                                                <option data-code="TN" value="46">Tây Ninh</option>



                                                                <option data-code="VL" value="55">Vĩnh Long</option>



                                                                <option data-code="VT" value="17">Vĩnh Phúc</option>



                                                                <option data-code="YB" value="10">Yên Bái</option>



                                                                <option data-code="DB" value="7">Điện Biên</option>



                                                                <option data-code="DC" value="42">Đắk Lắk</option>



                                                                <option data-code="DO" value="43">Đắk Nông</option>



                                                                <option data-code="DN" value="48">Đồng Nai</option>



                                                                <option data-code="DT" value="56">Đồng Tháp</option>



                                                            </select>
                                                        </div>


                                                    </div>


                                                    <div class="field field-show-floating-label  field-third ">
                                                        <div class="field-input-wrapper field-input-wrapper-select">
                                                            <label class="field-label" for="customer_shipping_district">Quận/Huyện</label>
                                                            <select class="field-input" id="customer_shipping_district" name="customer_shipping_district">
                                                                <option data-code="null" value="null" selected>Chọn
                                                                    Quận/Huyện</option>

                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="field field-show-floating-label   field-third  ">
                                                        <div class="field-input-wrapper field-input-wrapper-select">
                                                            <label class="field-label" for="customer_shipping_ward">Phường</label>
                                                            <select class="field-input" id="customer_shipping_ward" name="customer_shipping_ward">
                                                                <option data-code="null" value="null" selected>Chọn
                                                                    phường</option>

                                                            </select>
                                                        </div>

                                                    </div>



                                                    <div id="div_location_country_not_vietnam" class="section-customer-information ">
                                                        <div class="field field-two-thirds">
                                                            <div class="field-input-wrapper">
                                                                <label class="field-label" for="billing_address_city">Thành phố</label>
                                                                <input placeholder="Thành phố" autocapitalize="off" spellcheck="false" class="field-input" size="30" type="text" id="billing_address_city" name="billing_address[city]" value="" />
                                                            </div>
                                                        </div>
                                                        <div class="field field-third">
                                                            <div class="field-input-wrapper">
                                                                <label class="field-label" for="billing_address_zip">Mã
                                                                    bưu chính</label>
                                                                <input placeholder="Mã bưu chính" autocapitalize="off" spellcheck="false" class="field-input" size="30" type="text" id="billing_address_zip" name="billing_address[zip]" value="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                


                                                <div id="form_update_location_customer_pick_at_location" class="radio-wrapper content-box-row content-box-row-padding content-box-row-secondary hidden" for="customer_pick_at_location_true">
                                                    <input name="utf8" type="hidden" value="✓">
                                                    <input name="inventory_location_country_id" type="hidden" value="241">
                                                    <div class="field field-third ">
                                                        <div class="field-input-wrapper field-input-wrapper-select">
                                                            <label class="field-label" for="inventory_location_province">Tỉnh</label>
                                                            <select class="field-input" id="inventory_location_province" name="inventory_location_province">
                                                                <option data-code="null" value="null" selected>Chọn tỉnh
                                                                    thành</option>





                                                                <option data-code="HI" value="1">Hà Nội</option>





























































































































                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>



                                            </div>
                                        </form>

                                    </div>

                                </div>
                                <div id="change_pick_location_or_shipping">

                                    <div class="inventory_location">

                                    </div>



                                    <div id="section-shipping-rate">
                                        <div class="section-header">
                                            <h2 class="section-title">Phương thức vận chuyển</h2>
                                        </div>
                                        <div class="section-content">

                                            <div class="content-box  blank-slate">
                                                <i class="blank-slate-icon icon icon-closed-box "></i>
                                                <p>Vui lòng chọn tỉnh / thành để có danh sách phương thức vận chuyển.
                                                </p>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="section-payment-method" class="section">
                                        <div class="section-header">
                                            <h2 class="section-title">Phương thức thanh toán</h2>
                                        </div>
                                        <div class="section-content">
                                            <div class="content-box">



                                                <div class="radio-wrapper content-box-row">
                                                    <label class="radio-label" for="payment_method_id_1002706248">
                                                        <div class="radio-input payment-method-checkbox">
                                                            <input type-id='1' id="payment_method_id_1002706248"
                                                                class="input-radio" name="payment_method_id"
                                                                type="radio" value="1002706248" checked />
                                                        </div>
                                                        <div class='radio-content-input'>
                                                            <img class='main-img'
                                                                src="https://hstatic.net/0/0/global/design/seller/image/payment/cod.svg?v=1" />
                                                            <div>
                                                                <span class="radio-label-primary">Thanh toán khi giao
                                                                    hàng (COD)</span>
                                                                <span class='quick-tagline hidden'></span>
                                                                <span class='quick-tagline  hidden '>Buy Now, Pay Later

                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>







                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                        </div>
                        <div class="step-footer">

                            <form id="form_next_step" accept-charset="UTF-8" method="post">
                                <input name="utf8" type="hidden" value="✓">
                                <button type="submit" class="step-footer-continue-btn btn">
                                    <span class="btn-content">Đặt hàng</span>
                                    <i class="btn-spinner icon icon-button-spinner"></i>
                                </button>
                            </form>
                            <a class="step-footer-previous-link" href="/cart">
                                Giỏ hàng
                            </a>

                        </div>
                    </div>

                </div>
                <div class="main-footer footer-powered-by">
                    Powered by Haravan
                </div>
            </div>
        </div>

    </div>

</body>

</html>
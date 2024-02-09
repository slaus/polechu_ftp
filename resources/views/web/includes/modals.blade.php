<div id="modal" class="modal-mask" style="display: none">
    <div class="modal-wrapper">
        <div class="modal-container">
            <div class="modal-order">
                <button id="closeModalButton" class="button close-button">
                    <img class="card__option-img" src="/images/icons/cross.svg" alt="Icon" />
                </button>
            </div>

            <div class="modal-title-h3">{{ __('Application for selecting a tour') }}</div>
            <div class="mb-20">
                Хочеш полетіти з нами на відпочинок? Ми все організуємо)
                Давай знайомитись! Залишай номер телефону і коментар про свої побажання, ми напишемо тобі протягом 1 години в робочий час.
            </div>

            <div>
                <form action="{{ route('form.tour') }}" class="row" id="searchTourForm" method="post" name="form-search-tour">
                    <div class="form-fields-wrapper">
                        <input name="name" placeholder="{{ __('Name *') }}" type="text">
                        <span></span>

                        <input name="email" placeholder="{{ __('Email *') }}" type="text">
                        <span></span>

                        <input name="phone" placeholder="{{ __('Phone *') }}" type="text">
                        <span></span>

                        <textarea name="text" placeholder="{{ __('Note') }}" rows="4"></textarea>

                        <div class="success" id="requestSendSuccess">
                            {{ __('Thank you. Your message has been sent') }}
                        </div>

                        <div class="error" id="requestSendFail">
                            {{ __('Error, email not sent') }}
                        </div>

                        <div class="error" id="requestFormErrors"></div>
                    </div>
                </form>
            </div>

            <div class="modal-action">
                <button id="searchTourSubmit" class="send-request">
                    {{ __('Send request search tour') }}
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .mb-20 {
        margin-bottom: 20px;
    }

    .modal-mask {
        position: fixed;
        z-index: 99999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: table;
        transition: opacity 0.3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        max-height: 90vh;
        overflow-y: auto;
        margin: 0 auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Helvetica, Arial, sans-serif;
        width: 100%;
        max-width: 450px;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .modal-default-button {
        float: right;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    .modal-order {
        font-family: Montserrat, sans-serif;
        position: relative;
    }

    .close-button {
        width: 40px;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: -5px;
        right: -10px;
        padding: 0;
    }

    .close-button img {
        width: 20px;
        height: 20px;
        margin-right: 0;
    }

    .form-fields-wrapper {
        display: flex;
        flex-direction: column;
        gap: 4px;
        margin-bottom: 8px;
    }

    .modal-action {
        width: 100%;
        text-align: center;
    }
    .send-request {
        background: #3bb0ff;
        border: 1px solid transparent;
        border-radius: 0;
        color: #fff;
        cursor: pointer;
        display: block;
        font-size: 16px;
        font-weight: 400;
        height: 40px;
        line-height: 40px;
        margin: 4px auto;
        outline: none;
        padding: 0 14px;
        text-align: center;
        transition: all .3s ease;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        white-space: nowrap;
    }
    .send-request:hover {
        background: #ccc;
    }
    .send-request.active,
    .send-request:active {
        background-image: none;
        outline: 0;
        -webkit-box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
        box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
    }

    .modal-title-h3 {
        font-size: 13pt;
        font-weight: 500;
        text-transform: uppercase;
        margin: 35px 0 20px 0;
        text-align: center;
    }
</style>

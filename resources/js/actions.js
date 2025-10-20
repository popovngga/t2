window.handleSubmitButtonOnClick = function(button) {
    button.disabled = true;
    button.closest('form').submit();
};

document.addEventListener('DOMContentLoaded', function() {
    var inputs = document.querySelectorAll('#docproprietario, #proprietarioimovel, #tipoimovel');
  
    inputs.forEach(function(input) {
        function checkValue() {
            if (input.value.trim() !== "" && input.value !== null) {
                input.classList.add('has-value');
            } else {
                input.classList.remove('has-value');
            }
        }

        // Initial check in case there's already a value when the page loads
        checkValue();

        // Event listener for input changes
        input.addEventListener('input', checkValue);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var select = document.getElementById('selestrategia');

    function checkValue() {
        if (select.value.trim() !== "") {
            select.classList.add('has-value');
        } else {
            select.classList.remove('has-value');
        }
    }

    // Initial check in case there's already a value when the page loads
    checkValue();

    // Event listener for select changes
    select.addEventListener('change', checkValue);
});

<div id="dda-loader">
    <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}"
         alt="Deities Design Awards"
         id="dda-loader-logo">

    <div id="dda-loader-line"></div>
</div>

<script>
    document.getElementById('dda-loader').addEventListener('animationend', function (e) {
        if (e.animationName === 'loaderOut') this.remove();
    });
</script>
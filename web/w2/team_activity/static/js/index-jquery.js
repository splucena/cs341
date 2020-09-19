

$(() => {    
    // Display an alert box when button 'Click Me' is pressed.
    $('#btn-click-me').click((e) => {
        alert('Clicked using jQuery!');
    });

    $('#btn-change-color').click((e) => {        
        let inputColor = $('#input-change-color').val();
        $('div.div-container > div:nth-child(2)').css('background-color', inputColor);
    });

    $('#btn-toggle-animation').click((e) => {
        let inputColor = $('#input-change-color').val();
        $('div.div-container > div:nth-child(2)')
        .css({
            'background-color': inputColor,
            'transition': 'background-color 5s linear'});
    });
});
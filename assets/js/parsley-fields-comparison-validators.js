//  Not equal to validator
window.ParsleyValidator.addValidator('notequalto', 
    function (value, requirement) {
        return value !== $(requirement).val();
    }, 32)
    .addMessage('en', 'notequalto', 'This value should not be the same.');

// Greater than validator
window.ParsleyValidator.addValidator('gt', 
    function (value, requirement) {
        return parseFloat(value) > parseFloat($(requirement).val());
    }, 32)
    .addMessage('en', 'gt', 'This value should be greater');

// Greater than or equal to validator
window.ParsleyValidator.addValidator('ge', 
    function (value, requirement) {
        return parseFloat(value) >= parseFloat($(requirement).val());
    }, 32)
    .addMessage('en', 'ge', 'This value should be greater or equal');

// Less than validator
window.ParsleyValidator.addValidator('lt', 
    function (value, requirement) {
        return parseFloat(value) < parseFloat($(requirement).val());
    }, 32)
    .addMessage('en', 'lt', 'This value should be less');

// Less than or equal to validator
window.ParsleyValidator.addValidator('le', 
    function (value, requirement) {
        return parseFloat(value) <= parseFloat($(requirement).val());
    }, 32)
    .addMessage('en', 'le', 'This value should be less or equal');

// // Greater than validator non zero value
// window.ParsleyValidator.addValidator('gtz', 
//     function (value, requirement) {
//         return parseFloat(value) > parseFloat($(requirement).val());
//     }, 32)
//     .addMessage('en', 'gtz', 'This value should be greater');

// // Less than validator non zero value
// window.ParsleyValidator.addValidator('ltz', 
//     function (value, requirement) {
//         return parseFloat(value) < parseFloat($(requirement).val());
//     }, 32)
//     .addMessage('en', 'ltz', 'This value should be less');


// Greater than validator non zero value
window.ParsleyValidator.addValidator('gtz', 
    function (value, requirement) {
        // alert(requirement);
        // var value1 = value.replace(":", "-");

        var timefrom = new Date();
        temp = value.split(":");
        // alert(temp);
        timefrom.setHours((parseInt(temp[0]) + 24) % 24);
        timefrom.setMinutes(parseInt(temp[1]));

        var timeto = new Date();
        // alert(requirement);
        // alert($(requirement).val());
        var fromtime = $(requirement).val();
        temp = fromtime.split(":");
        timeto.setHours((parseInt(temp[0]) + 24) % 24);
        timeto.setMinutes(parseInt(temp[1]));

        // alert(timefrom.toTimeString());
        // alert(timeto.toTimeString());
        // alert(requirement);        
        // if (timefrom < timeto) 
        // alert('start time should be smaller');
        first = timefrom.getHours()+':'+timefrom.getMinutes();
        second = timeto.getHours()+':'+timeto.getMinutes();
        // alert(timefrom)
        // alert(timeto)
        // hours = timeto.getHours();
        // minutes =  timeto.getMinutes();            
        if(second!='0:0' && first!='0:0')
            return timefrom > timeto;

        // // var first = value.toTimeString();
        // // var second = $(requirement).val().toTimeString();
        // // if(first!=0 && second!=0)
        // //     return first > second;
    }, 32)
    .addMessage('en', 'gtz', 'This value should be greater');

// Less than validator non zero value
window.ParsleyValidator.addValidator('ltz', 
    function (value, requirement) {
        var timefrom = new Date();
        // var value1 = value.replace(":", "-");        
        temp = value.split(":");
        timefrom.setHours((parseInt(temp[0])  + 24) % 24);
        timefrom.setMinutes(parseInt(temp[1]));
        var timeto = new Date();
        // alert($(requirement).val());
        var fromtime = $(requirement).val();
        temp1 = fromtime.split(":");
        timeto.setHours((parseInt(temp1[0])  + 24) % 24);
        timeto.setMinutes(parseInt(temp1[1]));
        first = timefrom.getHours()+':'+timefrom.getMinutes();
        second = timeto.getHours()+':'+timeto.getMinutes();
        if(second!='0:0' && first!='0:0')
            return timefrom < timeto;
    }, 32)
    .addMessage('en', 'ltz', 'This value should be less');


    window.ParsleyValidator.addValidator('departure', 
    function (value, requirement) {
        var value1 = $(requirement).val();
        if(value1 !='' && value!='') {
            var time1 = Date.parse(new Date(value1));
            var time2 = Date.parse(new Date(value));
            return time1<time2;
        }
    }, 32)
    .addMessage('en', 'departure', 'This value should be greater');

    // Less than validator non zero value
    window.ParsleyValidator.addValidator('arrival', 
    function (value, requirement) {
        var value2 = $(requirement).val();
        if(value !='' && value2!='') {
            var time1 = Date.parse(new Date(value));
            var time2 = Date.parse(new Date(value2));
            return time1<time2;
        }
    }, 32)
    .addMessage('en', 'arrival', 'This value should be less');
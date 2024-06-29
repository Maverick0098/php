function checkEligibility(){
    const age = parseInt(document.getElementById('ageinput').value);
    let resultElement = document.getElementById('r');
    let message = '';
    switch (true) {
        case (isNaN(age) || age < 0):
            message = 'Please enter a valid age.';
            resultElement.style.color = 'black';
            break;
        case (age < 18):
            message = 'You are not eligible to vote.';
            resultElement.style.color = 'red';
            break;
        case (age >= 18):
            message = 'You are eligible to vote.';
            resultElement.style.color = 'green';
            break;
        default:
            message = 'Please enter a valid age.';
            resultElement.style.color = 'black';
    }
    resultElement.innerText = message;
}
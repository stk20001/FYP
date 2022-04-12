/* Functions for JS */

function door_check(){
    var result = confirm('Door will be unlocked for 10 seconds \n Confirm open the door:');
    if (result == false){
        event.preventDefault();
    }
}

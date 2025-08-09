export function statusOnline(){

    window.Echo.join('online-users')
        .here(users => {
            users.forEach(user => {
                $(`#user-${user.id}`).text('Online');
                
            });
        })
        .joining(user => {
            $(`#user-${user.id}`).text('Online');
            $(`#userOnline`).css('background-color', 'green');

        })
        .leaving(user => {
            $(`#user-${user.id}`).text('Offline');
            $(`#userOnline`).css('background-color', 'red');
        });

}    

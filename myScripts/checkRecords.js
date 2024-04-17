// Function to check for new records
function checkForNewRecords() {
    $.ajax({
        url: 'check_for_new_records.php', // URL of your server-side script
        method: 'GET',
        success: function(response) {
            if (response === 'true') {
                // There are new records, perform your desired action
                if (window.location.pathname.includes('/Professor/Home_Professor')) {
                    // If the current page is Professor/Home_Professor
                    updateTable();
                }
                
                playSound(); //try 
               
                console.log('New records found!');
                // For example, you could update the UI or display a notification
            } else {
                // No new records
                console.log('No new records');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
// Function to play a sound
function playSound() {
    try {
        var audio = new Audio('../notifxyles.mp3'); // Replace 'notification_sound.mp3' with the path to your sound file
        audio.play();
    } catch (e){
        console.error('An error occurred:', error);
    }
}
// Call the function initially
checkForNewRecords();

// Set an interval to periodically check for new records (every 5 seconds in this example)
setInterval(checkForNewRecords, 5000); // Adjust the interval as needed

function count() {
    console.log('count')
    // Perform an AJAX request to fetch the counts from the PHP script
    $.ajax({
        url: 'count_records.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the counts in the UI
            $('#h6CountConsult').text(response.countconsult);
            $('#h6CountSub').text(response.countsubmit);

            // Proceed with updating the table or other actions
            // You can call other functions or perform additional AJAX requests here
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            console.error('Error:', xhr.responseText);
        }
    });

    // Continue with other code as needed
}



// Function to update the table based on the selected ordering and direction
function updateTable(e,dateRange) {
    count()
    // Get the selected ordering and direction
    var orderBy = $('#orderByCSelect').val();
    var direction = $('#orderCSelect').val();
    dateRange = dateRange ?? null;
    
    console.log('updating table')
    // Perform an AJAX request to fetch the updated data from the server
    // Send the selected ordering and direction to the server
    $.ajax({
        url: 'load_consult_cards.php',
        type: 'GET',
        data: { orderBy: orderBy,
            direction: direction,
            dateFilter: dateRange
         },
        dataType: 'json',
        success: function(response) {
            // console.log(response)
            if (response.length > 0){
                $.each(response, function(i, field){

                    var card = $('#divConsultCardsTemplate').html();
                    card = card.replace('Section_Desc',field.Section)
                    card = card.replace('userName',field.Name)
                    card = card.replace('$Purpose',field.Purpose)
                    var sqlDateTimeString = field.Date.date
                    var formattedDateTime = new Date(sqlDateTimeString.replace(/-/g, '/')).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: true});

                    card = card.replace('requestedDate',formattedDateTime)
                    card = card.replace(/TransactNum/g,field.TransactionID)
                    var submittedDateTime = field.DateSubmitted.date
                    var formattedSubmittedDate = new Date(submittedDateTime.replace(/-/g, '/')).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: false});

                    card = card.replace(/submittedDate/g,formattedSubmittedDate)
                    // Get today's date
                    let today = new Date();

                    // Assuming field.DateSubmitted is in the format "YYYY-MM-DD", you can parse it into a Date object
                    let submittedDate = new Date(field.DateSubmitted.date);
                    let sevenDaysAgo = new Date(today);
                    sevenDaysAgo.setDate(today.getDate() - 7);
                    let yearAgo = new Date(today);
                    yearAgo.setDate(today.getDate() - 365);

                    console.log(`field.DateSubmitted: ${field.DateSubmitted}
                    submittedDate: ${submittedDate}
                    ${submittedDate.toDateString()} === ${today.toDateString()}
                    sevenDaysAgo: ${sevenDaysAgo}
                    ${submittedDate.toDateString() === today.toDateString()}`)
                    if (submittedDate.toDateString() === today.toDateString()){
                        $('#divConsultationCards .consultCardToday').show('medium')
                        $('#divConsultationCards .consultCardToday').append(card)
                    } else if (submittedDate >= sevenDaysAgo && submittedDate <= today) {
                        // Append the card to the specified div
                        $('#divConsultationCards .consultCardThisWeek').show('medium');
                        $('#divConsultationCards .consultCardThisWeek').append(card);
                    } else {
                        $('#divConsultationCards .consultCardOthers').show('medium');
                        $('#divConsultationCards .consultCardOthers').append(card);
                    }
                })
            }

            // Replace the existing table with the updated table
            // $('#tbodyCTable').html(response);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText)
            console.error(status)
            console.error(error)
            console.error('Failed to load consult cards');
        }
    });
}

// Call the updateTable function once initially to populate the table
updateTable();
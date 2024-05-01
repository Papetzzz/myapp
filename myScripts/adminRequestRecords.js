function fetchRequests(Mode){
    $('#documentRequests').empty()
    $('#consultationRequests').empty()
    
    var year = $('#filterByYear').val()
    var section = $('#filterBySection').val()
    var start = $('#filterByStart').val()
    var end = $('#filterByEnd').val()
    var profID = $('#filterByProfessor').val()
    var docTypeID;
    var isReceived = $('#docIsReceived').is(':checked')
    var isApproved = $('#consultIsApparoved').is(':checked')
    var isDocument = false;
    if ($('#documents-tab').hasClass('active')){
        isDocument = true;
        docTypeID = $('#filterByDocName').val();
    } else {
        isDocument = false
        docTypeID = null;
    }
    var suggestedStart = $('#filterRequestedByStart').val()
    var suggestedEnd = $('#filterRequestedByEnd').val()

    $.ajax({
        url: 'fetch_requests.php',
        method: 'GET',
        data: {
            IsDocument: isDocument,
            Year: year,
            Section: section,
            StartDate: start,
            EndDate: end,
            ProfID: profID,
            DocTypeID: docTypeID,
            IsReceived: isReceived,
            IsApproved: isApproved,
            SuggestedStart: suggestedStart,
            SuggestedEnd: suggestedEnd
        },
        dataType: 'json',
        success: function(response) {

            var countS = 0
            var countC = 0
            $(response).each(function(i,field){
                
                if (field.Code == 'S'){
                    
                    countS++
                    var s = $('#documentRequestsTemplate').html()
                    s = s.replace("Name_Professor",field.Name)
                    s = s.replace("RequestPurpose",field.Purpose)
                    var submittedDateTime = field.DateSubmitted.date
                    var formattedSubmittedDate = new Date(submittedDateTime.replace(/-/g, '/')).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: false});
                    s = s.replace("RequestDate",formattedSubmittedDate)
                    s = s.replace("RequestIsReceived",field.IsReceived)
                    s = s.replace("RequestDocType",field.Type)
                    if (countS%2 == 0){
                        s = s.replace(/table_color/g,'table-active')
                    } 
                    
                    $('#documentRequests').append(s)
                    
                }
                else if (field.Code == 'C'){
                    console.log(field)
                    countC++;
                    var c = $('#consultationRequestsTemplate').html()
                    c = c.replace("Name_Professor",field.Name)
                    c = c.replace("Name_Student",field.Student ?field.Student :''   )
                    c = c.replace("RequestPurpose",field.Purpose)
                    c = c.replace("RequestStatus",field.Status)
                    var submittedDateTime = field.DateSubmitted.date
                    var formattedSubmittedDate = new Date(submittedDateTime.replace(/-/g, '/')).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: false});
                    c = c.replace("RequestDate",formattedSubmittedDate)
                    var suggestedDateTime = field.RequestDateTime.date
                    var formattedSuggestedDate = new Date(suggestedDateTime.replace(/-/g, '/')).toLocaleDateString('en-US', {year: 'numeric', month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: false});
                    c = c.replace("RequestDateTime",formattedSuggestedDate)
                    c = c.replace("RequestRemarks",field.Remarks ? field.Remarks:' - ')
                    if (field.Status == 'Approved'){
                        c = c.replace(/table_status/g,'tr-Approved')
                    }else if (field.Status == 'Rejected'){
                        c = c.replace(/table_status/g,'tr-Rejected')
                    } else {
                        c = c.replace(/table_status/g,'')

                    }
                    if (countC%2 == 1){
                        c = c.replace(/table_color/g,'table-active')
                    } 

                    $('#consultationRequests').append(c)

                }
            })
            
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            console.error('Error:', xhr.responseText);
        }
    });
}

function getRequests(){
    $.ajax({
        url:'.php',
        method:'GET',
        data:{

        },
        dataType:'json',
        success:function(response){

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            console.error('Error:', xhr.responseText);
        }

    })
}
var sections;
function getDataList(){
    sections = []
    $.ajax({
        url:'fetch_data.php',
        method:'GET',
        data:{

        },
        dataType:'json',
        success:function(response){
            console.log(response)
            var docType = response.DocumentType;
            var profs = response.Professors;
            var years = response.Years;
            sections = response.Sections;
            $.each(docType, function(i,field){
                $('#filterByDocName').append(new Option(field.Type,field.DocumentTypeId))
            })
            $.each(profs, function(i,field){
                $('#filterByProfessor').append(new Option(field.Name,field.UserID))
            })
            $.each(years, function(i,field){
                $('#filterByYear').append(new Option(field,field))
            })
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            console.error('Error:', xhr.responseText);
        }

    })
}

$('#filterByYear').change(function(){
    $('#filterBySection').empty()
    fetchRequests()
    // Get the selected option value
    var selectedOption = $(this).val();
    if (selectedOption != null){
        $('#filterBySection').prop('disabled',false)
        $('#filterBySection').append(new Option('',''))
        $.each(sections, function(i,field){
            if (field.Year == selectedOption){
                $('#filterBySection').append(new Option(field.Description,field.SectionID))
            }
        })

    } else {
        $('#filterBySection').prop('disabled',true)

    }
});

$('#filterBySection').change(function(){
    fetchRequests()
})

$('#filterByProfessor').change(function(){
    fetchRequests()
})

$('#filterByStart').focusout(function(){
    fetchRequests()
})

$('#filterByEnd').focusout(function(){
    fetchRequests()
})
$('#filterRequestedByStart').focusout(function(){
    fetchRequests()
})
$('#filterRequestedByEnd').focusout(function(){
    fetchRequests()
})

$('#filterByDocName').change(function(){
    fetchRequests()
})
$('#docIsReceived').change(function(){
    fetchRequests()
})
$('#consultIsApparoved').change(function(){
    fetchRequests()
})

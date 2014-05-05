
function getSelected(type)
{
    AllAlbums = [];
    if(type == 'selected')
    {
        TotalAblums = $('input:checkbox:checked').length;
        if(TotalAblums > 0)
        {
            $('input:checkbox:checked').each(function()
            {
                getAlbumPhotos($(this).attr("id"), $(this).attr('data-name'));
            });
        }
        else
        {
            alert("Please select any one album to download");
        }
    }
    else
    {
        TotalAblums = $('input:checkbox').length;
        if(TotalAblums > 0)
        {
            $('input:checkbox').each(function()
            {
                getAlbumPhotos($(this).attr("id"), $(this).attr('data-name'));
            });
        }
    }
}

function downloadOne(id, name)
{
    AllAlbums = [];
    TotalAblums = 1;
    getAlbumPhotos(id, name);
}

function gotAlbums(data)
{
    AllAlbums.push(data);
    if(AllAlbums.length == TotalAblums)
    {
        var postData = {};
        postData['action'] = 'startDownload';
        postData['albums'] = AllAlbums;

        console.dir(AllAlbums);

        $.ajax({
            type: "POST",
            url: "downloadAlbum.php",
            data: postData,
            dataType: "json",
            success:function(ResponseData) {
                if(ResponseData['result'] == 'success')
                {
                    $('#my_buttons').append('<p><a href="javascript:void(0);" class="button" onclick="window.location = \'downloadAlbum.php?albums='+ResponseData['msg']+'\'">Start Download</a></p>');
                }
                else
                {
                    alert(ResponseData['msg']);
                }
            }
        });
    }
}
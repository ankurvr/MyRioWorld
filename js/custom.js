
function getSelected()
{
    AllAlbums = [];
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
                    alert(ResponseData['msg']);
                }
                else
                {
                    alert(ResponseData['msg']);
                }
            }
        });
    }

}
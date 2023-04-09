var selectedListMusicGroup = [],
    selectBox = document.getElementById("multipleSelectIdMusicGroup"),
    i;
 
for (i=0; i < selectBox.options.length; i++) 
{
	if (selectBox.options[i].selected) 
	{
		selectedListMusicGroup.push(selectBox.options[i]);
	}
}


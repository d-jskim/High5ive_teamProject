// const list_items = document.querySelectorAll('.cards');
// const lists = document.querySelectorAll('.list');
// const edit = document.querySelector('#edit');
// const save = document.querySelector('#save');
// const del = document.querySelectorAll('#delete')
// const childCon = document.querySelectorAll('.children-container')


let edit = document.querySelector('#edit');
let save = document.querySelector('#save');
let handOpen = document.querySelectorAll('#handOpen')
let handClosed = document.querySelectorAll('#handClosed')



save.addEventListener('click', () => { 
	let handOpen = document.querySelectorAll('#handOpen')


	for (let i = 0; i < handOpen.length; i++) {
		handOpen[i].style.display = 'none'
	}
let del = document.querySelectorAll('#delete')
let list_items = document.querySelectorAll('.cards'); // when i click save i don't want items to be editable or deletable
	for (let i = 0; i < list_items.length; i++) { //loops through boxes
		let delItem = del[i] // each delete button is selected
		delItem.disabled = true; // each delete button is now disabled - will not work
		list_items[i].setAttribute("draggable", "false"); // each box item can not be dragged
	}

	
})

edit.addEventListener('click', () => { // when i click edit i want every item to be editable and deletable
let handOpen = document.querySelectorAll('#handOpen')
let handClosed = document.querySelectorAll('#handClosed')

let del = document.querySelectorAll('#delete')
let list_items = document.querySelectorAll('.cards');
let lists = document.querySelectorAll('.list');
for (let i = 0; i < handOpen.length; i++) {
	handOpen[i].style.display = 'inline-block'
}


let childCon = document.querySelectorAll('.children-container')


	for (let i = 0; i < del.length; i++) { // loop through delete boxes
		let delItem = del[i] // select each individual delete box
		delItem.disabled = false; // it is not disabled anymore, can be clicked
		delItem.addEventListener('click', deleteMovie)
	}

	for (let i = 0; i < list_items.length; i++) { // i go through all of the cards
        let item = list_items[i]; // i select each card
		list_items[i].style.cursor = "grab"
		item.setAttribute("draggable", "true") // each card can now be dragged
		
		item.addEventListener('dragstart', function (e) { 
			console.log(e)
			item.style.cursor = "grab"
			for (let i = 0; i < handOpen.length; i++) {
				handOpen[i].style.display = 'none'
			}
			
			for (let i = 0; i < handClosed.length; i++) {

				if (e.path[0].children[7]) {
					e.path[0].children[7].style.display = 'inline-block'
				} else if (e.path[0].children[5]) {
					e.path[0].children[5].style.display = 'inline-block'
				}
			}

            draggedItem = item;
            for (let x = 0; x < childCon.length; x++) {
				childCon[x].style.display = "none";
			}
			setTimeout(function () {
				item.style.display = 'none';
			}, 0)
		});
	
		item.addEventListener('dragend', function () {
            for (let x = 0; x < childCon.length; x++) {
				childCon[x].style.display = "block";
				for (let i = 0; i < handOpen.length; i++) {
					handOpen[i].style.display = 'inline-block'
				}
				
				for (let i = 0; i < handClosed.length; i++) {
					handClosed[i].style.display = 'none'
				}
			
			}
			setTimeout(function () {
				draggedItem.style.display = 'block';
			}, 0);
		})

		
	
		for (let j = 0; j < lists.length; j ++) {
			const list = lists[j];



			list.addEventListener('dragover', function (e) {
				e.preventDefault();
				list.style.cursor = "grab"
			});
			
			list.addEventListener('dragenter', function (e) {
                
				e.preventDefault();
				list.style.cursor = "grab"
	
			});
	
			list.addEventListener('dragleave', function (e) {
       
			});
	
			list.addEventListener('drop', function (e) {
				this.insertBefore(draggedItem, e.target);
				list.style.cursor = "grab"
		
			});
		}
	}
	
})


function deleteMovie(e) {
	console.log(e)

	let delThis = e.target.parentElement; // i select the parent element of the del button (which is the whole card)
	delThis.remove(); // i remove that card

	let movieTitle = ""

	if (e.path[1].childNodes[1].textContent) {
		movieTitle = e.path[1].childNodes[1].textContent
	} else if (e.path[1].children[1].textContent) {
		movieTitle = e.path[1].children[1].textContent
	}

	const delData = {
		"userId": userId,
		"title": movieTitle,
		"action": "deleteMovie"
	}

	let cardItems = document.querySelectorAll('.cards');
	let inputTitle = document.getElementById('title')
	let searchButton = document.getElementById('search')
	for (let i = 0; i < cardItems.length; i++) {
		console.log(cardItems[i])
		if (cardItems.length < 5) {
		// inputTitle.setAttribute("placeholder", "5 movies only!")
        // searchButton.style.display = 'none'
		// } else {
		searchButton.style.display = "inline-block"
        inputTitle.removeAttribute('placeholder') 
		}
	}

	var xhr = new XMLHttpRequest();
		xhr.open('POST', 'index.php');
		xhr.onreadystatechange = function() { //폴백
            if (xhr.readyState == 4 && xhr.status == 200) {
             console.log("success delete ajax");
            }
    }
	xhr.send(JSON.stringify(delData));
	
	

}
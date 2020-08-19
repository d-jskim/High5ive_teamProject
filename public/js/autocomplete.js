//Global variables

let searchElement = document.querySelector("#title"),
  results = document.getElementById("autocomplete"),
  currentSelectedMovie = -1,
  previousRequest,
  previousValue = searchElement.value;


//Request movie data
function movieTitleRequest(inputVal) {
  let input = inputVal;
  var searchList = [];
  fetch(
    `https://api.themoviedb.org/3/search/movie?api_key=a7a2be31391543b1180047cd25bd3045&language=en-US&query=${input}`
  )
    .then(response => {
      return response.json();
    })
    .then(data => {
      //retrieve movie title and date and push to list
      let titleDate;
      for (let i = 0; i < data.results.length; i++) {
        titleDate = {
          movieTitle: "",
          movieReleaseDate: ""
        };
        let movie = data.results[i];
        //filter to match input
        let title = movie.title.toLowerCase();
        if (title.startsWith(input)) {
          titleDate.movieTitle = movie.title;
          titleDate.movieReleaseDate = movie.release_date;
          //get rid of month/date
          titleDate.movieReleaseDate = titleDate.movieReleaseDate.slice(0, 4);
          searchList.push(titleDate);
        
        }
      }

      //sort titles alphabetically
      searchList.sort(function(a, b) {
        if (a.movieTitle < b.movieTitle) {
          return -1;
        }
        if (a.movieTitle > b.movieTitle) {
          return 1;
        }
        return 0;
      });

      createList(searchList);
      console.log(results);
    });
}

//create html div with search suggestions list
function createList(searchList) {
  //hide if no results
  results.style.display = searchList.length ? "block" : "none";
  if (searchList.length) {
    //clear results
    results.innerHTML = "";
    //create html elements and mouse click event listener
    for (let i = 0; i < searchList.length; i++) {
      let div = results.appendChild(document.createElement("div"));
      div.textContent =
        searchList[i].movieTitle + "  " + searchList[i].movieReleaseDate;
      div.classList.add("results");
      div.id = "result" + i;
      div.addEventListener("click", function(e) {
        selectMovie(e.target);
      });
    }
  }
}

//choose result and reset display
function selectMovie(result) {
  //change input and store as previous value
  searchElement.value = previousValue = result.innerHTML;
  //hide search results
  results.style.display = "none";
  //get rid of focus
  result.className = "";
  //reset selection value
  currentSelectedMovie = -1;
  //if selected, add focus back
  searchElement.focus();
}

//manage results display
searchElement.addEventListener("keyup", function(e) {
  let divs = document.querySelectorAll("#autocomplete div");
  if (e.keyCode == 38 && currentSelectedMovie > -1) {
    //key up
    divs[currentSelectedMovie--].className = "";

    if (currentSelectedMovie > -1) {
      divs[currentSelectedMovie].className = "div_focus";
    }
  } else if (e.keyCode == 40 && currentSelectedMovie < divs.length - 1) {
    //key down
    results.style.display = "block";

    if (currentSelectedMovie > -1) {
      divs[currentSelectedMovie].className = "";
    }

    divs[++currentSelectedMovie].className = "div_focus";
  } else if (e.keyCode == 13 && currentSelectedMovie > -1) {
    //enter key
    selectMovie(divs[currentSelectedMovie]);
  } else if (searchElement.value != previousValue) {
    //determine if search input changed
    previousValue = searchElement.value;

    //store new search request
    previousRequest = movieTitleRequest(previousValue);

    //reset counter for every char
    currentSelectedMovie = -1;
  }
});

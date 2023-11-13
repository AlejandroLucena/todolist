import './bootstrap';

///////////////////////
// Global Data
///////////////////////

const tasks = [
    { title: "task 1", content: "lorem ipsum 1", status: "in_progress" },
    { title: "task 2", content: "lorem ipsum 2", status: "in_progress" },
    { title: "task 3", content: "lorem ipsum 3", status: "in_progress" },
    { title: "task 4", content: "lorem ipsum 4", status: "in_progress" },
    { title: "task 5", content: "lorem ipsum 5", status: "in_progress" },
]

//document.querySelector takes a css selector and returns the first element that matches that selector
const mainDiv = document.querySelector("main") // returns the one main element in our html

//below we will add our form inputs to some global variables
const titleInput = document.querySelector('input[name="title"]') //selecting the input with name property "name"
const contentInput = document.querySelector('input[name="content"]') //selecting the input with name property "name"
const createButton = document.querySelector("button#createitem") //select button with id "createitem"

//below we will add our update form inputs to some global variables
const updateTitle = document.querySelector('input[name="updatetitle"]') //selecting the input with name property "name"
const updateContent = document.querySelector('input[name="updateContent"]') //selecting the input with name property "name"
const updateFormButton = document.querySelector("button#updateitem") //select button with id "createitem"

///////////////////////
// Functions
///////////////////////

//define function for rendering current data to DOM, use this whenever data changes
const renderData = () => {
    //empty of the main div of any existing content
    mainDiv.innerHTML = ""

    //let us loop over the people array
    tasks.forEach((task, index) => {
        const taskH1 = document.createElement("h1") // Creates new h1 element
        const buttonContainer = document.createElement("aside") //create aside to store update/delete buttons

        //Update Button
        const updateButton = document.createElement(`button`) //create update button
        updateButton.id = index
        updateButton.innerText = "Update" //make the delete button say "Delete"
        updateButton.addEventListener("click", event => {
            updateTitle.value = task.title //set form to show current title
            updateContent.value = task.content //set form to show current content
            updateFormButton.setAttribute("toupdate", index) //custom attribute to use in the button event later
        })
        buttonContainer.appendChild(updateButton) //apend the delete button

        taskH1.innerText = `${task.title} ::: ${task.content} ` //ads text to the h1
        mainDiv.appendChild(taskH1) //append the h1 to the main element
        mainDiv.appendChild(buttonContainer) //append container of update and delete button
    })
}

const createData = () => {
    const title = titleInput.value //store value from title input into title variable
    const content = contentInput.value //store value from content input into content variable
    const newTask = { title, content } // create new Task object
    people.push(newTask) //push the new Task object into the array
    renderData() //render the data again so it reflects the new data
}

const updateData = event => {
    const index = event.target.getAttribute("toupdate") //get index we stored via custom attribute
    const title = updateTitle.value //get value from form
    const content = updateContent.value //get value from form
    tasks[index] = { title, content } //replace existing object at that index with a new with updated values
    renderData() //update the DOM with the new data
}

////////////////////
// Main App Logic
////////////////////

renderData() //call the render data function for the initial rendering of the data
createButton.addEventListener("click", createData) //trigger create data function whenever createButton is clicked
updateFormButton.addEventListener("click", updateData) //trigger update data function when updateButton is clicked

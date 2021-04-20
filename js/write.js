// #############################
// PUBLIC VARS AND CONSTS HERE 
// #############################

const saveWriting = document.getElementById("save-writing");
const writeSpace = document.getElementById("write-space");
const saveBtn = document.getElementById("save-writing");
const postBtn = document.getElementById("post-button");
const articleBox = document.getElementById("writing");
const postForm = document.getElementById("post-article");

// The editor content in JSON format
var JSONcode;

// the HTML format holder
let article = '';


// #############################
// OBJECTS HERE
// #############################

const editor = new EditorJS({
    // the item with the id editorjs
    holder: 'editorjs',
    // the tools that we integrate
    tools: {
        // the header tool
        header: {
            class: Header,
            config: {
                placeholder: 'Enter a header',
                levels: [2, 3, 4],
                shortcut: 'ALT+SHIFT+H',
                defaultLevel: 3
            }
        },
        // the list tool
        list: {
            class: List,
            inlineToolbar: true,
        },

    },

    //previously saved data
    data: {}
});


// ##################
// FUNCTIONS HERE 
// ###################

// save the writing in the hidden input value
const getArticle = () => {
    articleBox.value = article;
}

// turn the JSON into HTML and getArticle
const saveArticle = () => {

    // make sure article is empty
    article = '';

    editor.save()
        .then((savedData) => {
            JSONcode = savedData;

            // JSON to HTML
            JSONcode.blocks.forEach((block) => {
                switch (block.type) {
                    case 'header':
                        article += `<h${block.data.level}>${block.data.text}</h${block.data.level}>`;
                        break;
                    case 'paragraph':
                        article += `<p>${block.data.text}</p>`;
                        break;
                    case 'delimiter':
                        article += '<hr />';
                        break;
                    case 'image':
                        article += `<img class="img-fluid" src="${block.data.file.url}" title="${block.data.caption}" /><br /><em>${block.data.caption}</em>`;
                        break;
                    case 'list':
                        article += '<ul>';
                        block.data.items.forEach(function (li) {
                            article += `<li>${li}</li>`;
                        });
                        article += '</ul>';
                        break;
                    default:
                        console.log('Unknown block type', block.type);
                        console.log(block);
                        break;
                }
            });
            getArticle()
        });
}

// finish the writing and save it to the database
const postArticle = () => {
    saveArticle();
    postForm.submit();
}


// ##################
// EVENTS HERE 
// ###################

// hide writing preparations


// transform JSON to HTML
saveBtn.addEventListener('click', saveArticle);

// post the writing
postBtn.addEventListener('click', postArticle);
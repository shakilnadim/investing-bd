import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import Quote from '@editorjs/quote';
import List from '@editorjs/list';
import Table from '@editorjs/table';
import ImageTool from '@editorjs/image';
import { v4 as uuidv4 } from 'uuid';

let baseUrl = 'http://127.0.0.1:8000/';
let uuid = uuidv4();
let form = document.querySelector('.news-form');
let descriptionInput = document.querySelector('input[name="description"]');
let data = {};
if (descriptionInput.value !== ''){
    data = JSON.parse(descriptionInput.value);
}
let editor = new EditorJS({
    holder: 'editor',
    placeholder: 'Let`s write an awesome story!',
    data: data,
    tools: {
        header: {
            class: Header,
            shortcut: 'CMD+SHIFT+H',
            config: {
                placeholder: 'Enter a header',
                levels: [2, 3, 4],
                defaultLevel: 2
            }
        },
        quote: {
            class: Quote,
            inlineToolbar: true,
            shortcut: 'CMD+SHIFT+Q',
            config: {
                quotePlaceholder: 'Enter a quote',
                captionPlaceholder: 'Quote\'s author',
            },
        },
        list: {
            class: List,
            inlineToolbar: true,
            shortcut: 'CMD+SHIFT+L',
        },
        table: {
            class: Table,
            inlineToolbar: true,
        },
        image: {
            class: ImageTool,
            config: {
                endpoints: {
                    byFile: `${baseUrl}admin/news/image/upload`,
                    byUrl: `${baseUrl}admin/news/image/uploadByUrl`
                },
                additionalRequestData: {
                    uuid,
                    _token : document.querySelector('meta[name="csrf-token"]').content
                }
            }
        }
    },
});

form.addEventListener('submit', (e) => {
    e.preventDefault();
    editor.save().then((outputData) => {
        outputData.uuid = uuid;
        descriptionInput.value = JSON.stringify(outputData);
        form.submit();
    })
})



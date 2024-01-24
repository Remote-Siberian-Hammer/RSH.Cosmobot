document.getElementById('btn-add-dialog').onclick = function()
{
    document.getElementById('construct').insertAdjacentHTML('beforeend', `<section id="bot-dialog-step-${document.querySelectorAll(".bot-dialog").length}" class="point_listner col-2 mb-5 bot bot-dialog bot-draggable" style="position: absolute; top: 30%;"> \
    <div id="branch-dialog-left"></div> \
    <div class="card p-3 w-100 "> \
            <p>\
                <b>Добавить действие:</b>\
            </p> \
            <div class="row mb-3"> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgb(183 183 183);"> \
                            <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements d-flex justify-content-center align-items-center p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgb(183 183 183);"> \
                            <path d="M12 9c-1.626 0-3 1.374-3 3s1.374 3 3 3 3-1.374 3-3-1.374-3-3-3z"></path> \
                            <path d="M20 5h-2.586l-2.707-2.707A.996.996 0 0 0 14 2h-4a.996.996 0 0 0-.707.293L6.586 5H4c-1.103 0-2 .897-2 2v11c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V7c0-1.103-.897-2-2-2zm-8 12c-2.71 0-5-2.29-5-5s2.29-5 5-5 5 2.29 5 5-2.29 5-5 5z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements justify-content-center align-items-center p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(183 183 183);"> \
                            <path d="M12.186 14.552c-.617 0-.977.587-.977 1.373 0 .791.371 1.35.983 1.35.617 0 .971-.588.971-1.374 0-.726-.348-1.349-.977-1.349z"></path> \
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM9.155 17.454c-.426.354-1.073.521-1.864.521-.475 0-.81-.03-1.038-.06v-3.971a8.16 8.16 0 0 1 1.235-.083c.768 0 1.266.138 1.655.432.42.312.684.81.684 1.522 0 .775-.282 1.309-.672 1.639zm2.99.546c-1.2 0-1.901-.906-1.901-2.058 0-1.211.773-2.116 1.967-2.116 1.241 0 1.919.929 1.919 2.045-.001 1.325-.805 2.129-1.985 2.129zm4.655-.762c.275 0 .581-.061.762-.132l.138.713c-.168.084-.546.174-1.037.174-1.397 0-2.117-.869-2.117-2.021 0-1.379.983-2.146 2.207-2.146.474 0 .833.096.995.18l-.186.726a1.979 1.979 0 0 0-.768-.15c-.726 0-1.29.438-1.29 1.338 0 .809.48 1.318 1.296 1.318zM14 9h-1V4l5 5h-4z"></path> \
                            <path d="M7.584 14.563c-.203 0-.335.018-.413.036v2.645c.078.018.204.018.317.018.828.006 1.367-.449 1.367-1.415.006-.84-.485-1.284-1.271-1.284z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements justify-content-center align-items-center p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(183 183 183);"> \
                            <path d="M16 12V6c0-2.217-1.785-4.021-3.979-4.021a.933.933 0 0 0-.209.025A4.006 4.006 0 0 0 8 6v6c0 2.206 1.794 4 4 4s4-1.794 4-4zm-6 0V6c0-1.103.897-2 2-2a.89.89 0 0 0 .163-.015C13.188 4.06 14 4.935 14 6v6c0 1.103-.897 2-2 2s-2-.897-2-2z"></path> \
                            <path d="M6 12H4c0 4.072 3.061 7.436 7 7.931V22h2v-2.069c3.939-.495 7-3.858 7-7.931h-2c0 3.309-2.691 6-6 6s-6-2.691-6-6z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements justify-content-center align-items-center p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(183 183 183);"> \
                            <path d="M4 8H2v12a2 2 0 0 0 2 2h12v-2H4z"></path> \
                            <path d="M20 2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm-9 12V6l7 4z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements justify-content-center align-items-center p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(183 183 183);"> \
                            <path d="M6 18.573c2.206 0 4-1.794 4-4V4.428L19 7.7v7.43a3.953 3.953 0 0 0-2-.557c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4V7a.998.998 0 0 0-.658-.939l-11-4A.999.999 0 0 0 8 3v8.13a3.953 3.953 0 0 0-2-.557c-2.206 0-4 1.794-4 4s1.794 4 4 4z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(183 183 183);"> \
                            <path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements justify-content-center align-items-center p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(183 183 183);"> \
                            <path d="M4.222 19.778a4.983 4.983 0 0 0 3.535 1.462 4.986 4.986 0 0 0 3.536-1.462l2.828-2.829-1.414-1.414-2.828 2.829a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.829-2.828-1.414-1.414-2.829 2.828a5.006 5.006 0 0 0 0 7.071zm15.556-8.485a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0L9.879 7.051l1.414 1.414 2.828-2.829a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.829 2.828 1.414 1.414 2.829-2.828z"></path><path d="m8.464 16.95-1.415-1.414 8.487-8.486 1.414 1.415z"></path> \
                        </svg> \
                    </div> \
                </div> \
                <div class="col-2 p-1"> \
                    <div class="bot-elements justify-content-center align-items-center p-2"> \
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: rgba(183 183 183);"> \
                            <path d="M17.999 17c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2h-12c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h12zm-12-12h12l.002 10H5.999V5zm-2 14h16v2h-16z"></path> \
                        </svg> \
                    </div> \
                </div> \
            </div> \
            <button type="button" onclick="attach_menu_dialog('bot-dialog-menu-${document.querySelectorAll(".bot-dialog").length}')" class="btn btn-cb w-100">Добавить меню</button> \
        </div> \
        <div id="branch-dialog-right" class="branch-dialog-right-${document.querySelectorAll(".bot-dialog").length}" onclick="pin_line(${document.querySelectorAll(".bot-dialog").length})"></div> \
        <div id="bot-dialog-menu-${document.querySelectorAll(".bot-dialog").length}" class="mx-auto col-2 mt-3 w-100 "> \
        </div> \
    </section>`);

    $( function() {
        $( ".bot-draggable" ).draggable();
    } );
}

function attach_menu_dialog(idx)
{
    document.getElementById(idx).insertAdjacentHTML('beforeend', `<button type="button" class="d-block btn btn-add-dialog mb-2 w-100"> \
        <form> \
            <div id="branch-dialog-left" onclick="mouse_active_position()"></div> \
            <input class="form-control bot-dialog-menu-item" placeholder="Введите текст кнопки"> \
            <div id="branch-dialog-right"></div> \
        </form> \
    </button>`);
}
window.attach_menu_dialog = attach_menu_dialog;

function mouse_active_position()
{
    const startElement = document.getElementById('branch-dialog-left');
    const endElement = document.getElementById('branch-dialog-right');
    const mouseFollower = document.getElementById('mouse-follower');
    let line = new LeaderLine(startElement, mouseFollower, { path: 'follow', dash: {animation: true}});

    document.addEventListener('mousemove', (event) => {
        mouseFollower.style.left = `${event.clientX + 10}px`;
        mouseFollower.style.top = `${event.clientY - 10}px`;
        line.position();
    });
    function pin_line(idx, lineObject=line)
    {
        lineObject.end = document.querySelector(`.branch-dialog-right-${idx}`);
    }
    window.pin_line = pin_line;
}
window.mouse_active_position = mouse_active_position;


class MetaContent
{
    _idx;
    constructor(idx)
    {
        this._idx = idx;
    }
    text_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-text" class="mb-3"> \
                <label>Приветственное сообщение:</label> \
                <form><textarea name="" id="" class="form-control mb-2" rows="3" placeholder="Введите текст..."></textarea></form> \
            </section>');
    }
    photo_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-photo" class="mb-3"> \
                <label>Изображение в сообщении:</label> \
                <form><input type="file" class="form-control" accept="image/jpeg,image/png,image/gif,image/svg,image/webp"></form> \
            </section>');
    }
    doc_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-doc" class="mb-3"> \
            <label>Документ в сообщении:</label> \
            <form><input type="file" class="form-control" accept="doc/pdf,doc/epub,doc/txt,doc/xml,doc/csv,doc/zip,doc/rar,doc/html"></form> \
        </section>');
    }
    voice_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-voice" class="mb-3"> \
                <label>Вставить голосовое сообщение:</label> \
                <form><input type="file" class="form-control" accept="audio/ogg"></form> \
            </section>');
    }
    video_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-video" class="mb-3"> \
                <label>Видеофайл в сообщении:</label> \
                <form><input type="file" class="form-control" accept="video/mp3,video/mp4,video/avi,video/mtc"></form> \
            </section>');
    }
    audio_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-audio" class="mb-3"> \
                <label>Аудиофайл в сообщении:</label> \
                <form><input type="file" class="form-control" accept="audio/mp3,audio/mp4,audio/wav"></form> \
            </section>');
    }
    circle_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-circle" class="mb-3"> \
                <label>Круглое видеосообщение:</label> \
                <form><input type="file" class="form-control" accept="video/mp4"></form> \
            </section>');
    }
    link_created()
    {
        document.querySelector(`#${this._idx}`).insertAdjacentHTML('beforeend',
            '<section id="message-body-start-link" class="mb-3"> \
                <label>Указать ссылку источник:</label> \
                <form><input type="url" class="form-control"></form> \
            </section>');
    }
    deleted(id)
    {
        document.querySelector(`#${id}`).remove();
    }
}


function add_meta_data(type, idx)
{
    const meta = new MetaContent(idx);
    switch (type) {
        case 'text':
            meta.text_created()
            break;
        case 'photo':
            meta.photo_created()
            break;
        case 'doc':
            meta.doc_created()
            break;
        case 'voice':
            meta.voice_created()
            break;
        case 'video':
            meta.video_created()
            break;
        case 'audio':
            meta.audio_created()
            break;
        case 'circle':
            meta.circle_created()
            break;
        case 'link':
            meta.link_created()
            break;
     }
}
window.add_meta_data = add_meta_data;

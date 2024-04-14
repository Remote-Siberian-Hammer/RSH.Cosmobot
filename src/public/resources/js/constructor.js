// TODO: Проверить разные способы сборок (нестандартные)
// TODO: Сделать условия для действий и пользовательскими событиями
/*
* Пример:
{
    info: {
        name: 'Цветы по карману',
        platforms: [
            ['vk', 'my_vk_token'],
            ['tg', 'my_tg_token'],
        ],
    },
    messages_chain: [
        {
            id: 1,
            text: 'Привет мир!',
            buttons: [
                {type: 'inline', text: 'Расскажи анекдот', next_step: 2},
                {type: 'inline', text: 'Сделано в Cosmobot', url: 'https://example.com/'},
                {type: 'repty', text: 'Пока', next_step: 3},
            ]
            next_step: null, // или ID шага
        },
        {id: 2, text: 'Очень смешная шутка!', next_step: 1,},
        {id: 3, text: 'Досвидос!' next_step: null,},
        ...
    ]
}
* */
let bot = {
    info: {
        name: '',
        platforms: {
            vk: '',
            tg: ''
        }
    },
    messages_chain: [{id: null, text: '', buttons: [], next_step: null}]
};
add_active = (chain_id, mode="parent") =>
{
    for (let i =0; i < document.querySelectorAll('.bot').length; i++)
    {
        document.querySelectorAll('.bot')[i].classList.remove('bot-active');
    }
    var el = document.getElementById(chain_id);
    if (mode === "children")
    {
        el.addEventListener('click', function (event){
            try {
                document.getElementById(event.target.offsetParent.id).classList.add('bot-active');
                return;
            }
            catch (TypeError)
            {
                document.getElementById(
                    event.target
                        .offsetParent
                        .offsetParent
                        .id
                ).classList.add('bot-active');
                return;
            }
        });
    }
    else{
        try
        {
            el.classList.add('bot-active');
        }
        catch (TypeError) {}
        return;
    }
}
function GENERATE_UUID()
{
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(
        /[xy]/g,
        function(c) {
            var r = Math.random() * 16 | 0;
            return c == 'x' ? r : (r & 0x3 | 0x8).toString(16);
        });
}
var idx = GENERATE_UUID();
// Создание стартового элемента
const start_uuid = `action-${idx}`;
bot.messages_chain[0].id = start_uuid;
document.querySelector('#bot_strategy')
    .insertAdjacentHTML('beforeend',
    `<div id="${start_uuid}" class="bot card p-3">
                <div class="bot-header">
                    <p class="text-center">
                        <strong>Старт</strong>
                    </p>
                </div>
                <div class="bot-body">
                    <div class="dropdown">
                        <button class="btn btn-cb dropdown-toggle w-100"
                                type="button"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Реакция
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li>
                                <button type="button" class="dropdown-item" onclick="addBotStrategy('${start_uuid}')">Сообщение</button>
                                <button type="button" class="dropdown-item" onclick="addBotCondition()">Условие</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="botButtonList-${start_uuid}" class="bot-footer" style="display: none"></div>
            </div>`);
let chain_index = null;
let addBotStrategy = function(startElement, button_uuid=null)
{
    const index = `action-${GENERATE_UUID()}`;
    const idx = index;
    // Создание данных реакции
    bot.messages_chain.push({id: index, text: '', buttons: [], next_step: null});

    document.getElementById('bot_strategy').insertAdjacentHTML(
        'beforeend',
         `<div id="${index}" class="bot bot-dialog card p-3">
                <div class="bot-header">
                  <p class="text-center">
                    <strong onclick="add_active('${index}', 'children')">Сообщение</strong>
                  </p>
                </div>
                <div class="bot-body">
                  <div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-cb dropdown-toggle w-100" 
                        type="button" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false"
                        onclick="add_active('${index}', 'children')">
                      Реакция
                    </button>
                    <ul class="dropdown-menu w-100">
                      <li>
                        <button type="button" 
                            class="dropdown-item" 
                            onclick="addBotStrategy('${index}')">Сообщение</button>
                        <button type="button" 
                            class="dropdown-item" 
                            onclick="addBotCondition()">Условие</button>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="botButtonList-${index}" class="bot-footer" style="display: none"></div>
              </div>`
    );

    let i=0;
    while (i < bot.messages_chain.length)
    {
        // TODO: в первом шаге создаёт связь кнопки и действия, в последующих нет, разобраться
        if (bot.messages_chain[i].id === startElement.split('_')[2])
        {
            bot.messages_chain[i].next_step = index;
        }
        else
        {
            if (button_uuid)
            {
                for (let i=0; i < bot.messages_chain[i].buttons.length; i++)
                {
                    if (bot.messages_chain[i].buttons[i].id === button_uuid)
                    {
                        bot.messages_chain[i].buttons[i].next_step = index;
                    }
                }
            }
        }
        i++;
    }

    new PlainDraggable(document.getElementById(idx));
    let line = new LeaderLine(
        document.getElementById(startElement),
        document.getElementById(idx),
        {path: 'follow'}
    );

    document.addEventListener('mousemove', (event) => {
        line.position();
    });
    document.querySelector(`#${idx}`).addEventListener(
    'click', function (event){
        let dom_id = event.target.id;
        message.render(dom_id);
    });
}
let addBotCondition = function()
{

}
let addButtonChain = function ()
{
    const uuid = GENERATE_UUID();
    let groutCount = document.querySelectorAll('#inputChainButtonGroupContainer').length;
    document.getElementById('inputChainButtonGroup').insertAdjacentHTML('afterBegin', `
        <div id="inputChainButtonGroupContainer" class="container mt-3 button-${uuid}">
            <form>
                <div class="mb-3">
                    <label for="inputChainButtonText" class="form-label">Текст кнопки</label>
                    <input type="text" 
                        id="inputChainButtonText" 
                        class="form-control"
                        oninput="setChainButtonText('action-${uuid}', ${document.querySelectorAll('#botButtonTextElement'+ chain_index).length})">
                </div>
                <div class="mb-3">
                    <label class="form-label">Тип кнопки</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" 
                                type="radio" 
                                name="flexRadioDefault-${uuid}" 
                                id="inputChainButtonType" 
                                value="repty" 
                                oninput="setChainButtonType('${uuid}', 'repty')" 
                                checked>
                            <label class="form-check-label" for="inputChainButtonType">
                                Стандартная <small>
                                    <i>
                                        <a href="#">(Repty)</a>
                                    </i>
                                </small>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" 
                                type="radio" 
                                name="flexRadioDefault-${uuid}" 
                                id="inputChainButtonType" 
                                oninput="setChainButtonType('${uuid}', 'inline')" 
                                value="inline">
                            <label class="form-check-label" for="inputChainButtonType">
                                Кнопка в сообщении <small>
                                    <i>
                                        <a href="#">(Inline)</a>
                                    </i>
                                </small>
                            </label>
                        </div>
                    </div>
                </div>
                <div id="buttonInlineUrl" class="mb-3" style="display: none;">
                    <label for="inputChainButtonInlineUrl" class="form-label">Url адрес</label>
                    <input type="url" 
                        class="form-control"
                        id="inputChainButtonInlineUrl"
                        oninput="setChainButtonUrl('${uuid}')">
                </div>
            </form>
            <div class="dropdown">
                <button class="btn btn-cb dropdown-toggle w-100"
                    type="button"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Добавить действие
                </button>
                <ul class="dropdown-menu w-100">
                    <li>
                        <button type="button" class="dropdown-item" onclick="addBotStrategy('el-${uuid}', '${uuid}')">Сообщение</button>
                        <button type="button" class="dropdown-item" onclick="addBotCondition()">Условие</button>
                    </li>
                </ul>
            </div>
        </div>
    `);
    for (i=0; i < bot.messages_chain.length; i++)
    {
        if (bot.messages_chain[i].id === chain_index)
        {
            bot.messages_chain[i].buttons.push({
                id: uuid,
                type: 'repty',
                text: '',
                url: '',
                next_step: null
            });
        }
    }
    let el = document.getElementById(`botButtonList-${chain_index}`);
    el.style.display = 'block';
    el.insertAdjacentHTML(
'beforeend',
    `<div id="el-${uuid}" class="m-3">
            <button id="botButtonTextElement${chain_index}" type="button" class="btn btn-cb w-100"></button>
        </div>`
    )
}
function getButtonCollection(uuid)
{
    let data = null;
    for (var i=0; i < bot.messages_chain.length; i++)
    {
        for (let x=0; x < bot.messages_chain[i].buttons.length; x++)
        {
            if (uuid === bot.messages_chain[i].buttons[x].id)
            {
                data = bot.messages_chain[i].buttons[x];
            }
        }
    }
    // for (let i=0; i < bot.messages_chain[chain_index].buttons.length; i++)
    // {
    //     if (bot.messages_chain[chain_index].buttons[i].id === uuid)
    //     {
    //         data = bot.messages_chain[chain_index].buttons[i];
    //     }
    // }
    return data;
}
let setChainButtonText = function (uuid, idx)
{
    let button = getButtonCollection(uuid);
    button.text = document.getElementById('inputChainButtonText').value;
    for (var i=0; i < bot.messages_chain.length; i++)
    {
        for (let x=0; x < bot.messages_chain[i].buttons.length; x++)
        {
            if (uuid === bot.messages_chain[i].buttons[x].id)
            {
                document.querySelectorAll(`#botButtonTextElement${chain_index}`)[idx].innerText = bot.messages_chain[i].buttons[x].text;
            }
        }
    }
    return button;
}
let setChainButtonType = function(uuid, button_type)
{
    document.getElementById('buttonInlineUrl').style.display = button_type === 'inline' ? 'block' : 'none';
    let button = getButtonCollection(uuid);
    button.type = button_type;
    return button;
}
let setChainButtonUrl = function (uuid)
{
    let button = getButtonCollection(uuid);
    button.url = document.getElementById('inputChainButtonInlineUrl').value;
    return button;
}

class InputChainInfo
{
    getChain(chain_id)
    {
        let data = null;
        for (let i = 0; i < bot.messages_chain.length; i++)
        {
            if (bot.messages_chain[i].id === chain_id)
            {
                this.setToHTML(bot.messages_chain[i]) ;
            }
        }
    }
    setToHTML(chain)
    {
        // Text Message
        document.getElementById('inputChainText').value = '';
        document.getElementById('inputChainText').value = chain.text;
        //TODO: Вывести другие данные
    }
}

function setTextChain() {
    for (let i=0; i < bot.messages_chain.length; i++)
    {
        if (bot.messages_chain[i].id === chain_index)
        {
            bot.messages_chain[i].text = document.getElementById('inputChainText').value;
        }
    }

}

class BotFactory
{
    render() {}
}
class AbstractInfoBot
{
    render() {}
}
class AbstractInfoMessageBot
{
    render() {}
}

class InfoBotFactory extends BotFactory
{
    generate()
    {
        return new InfoBot();
    }
}
class InfoMessageBotFactory extends BotFactory
{
    generate()
    {
        return new InfoMessageBot();
    }
}
class InfoBot extends AbstractInfoBot
{
    render()
    {
        // Отображение данных о боте в полях
        document.getElementById('inputBotName').value = bot.info.name;
        document.getElementById('_vkAccessKey').value = bot.info.platforms.vk;
        document.getElementById('_tgAccessKey').value = bot.info.platforms.tg;

        document.getElementById('chainInfo').style.display = 'none';
        document.getElementById('botInfo').style.display = 'block';

        // Прослушка событий
        document.querySelector('#inputBotName').addEventListener(
        'input', function (event){
            bot.info.name = document.querySelector('#inputBotName').value;
        });
        // set & update access key
        document.getElementById('_vkAccessKey').addEventListener(
        'input', function (event){
            bot.info.platforms.vk = document.querySelector('#_vkAccessKey').value;
        });
        document.getElementById('_tgAccessKey').addEventListener(
        'input', function (event){
            bot.info.platforms.tg = document.querySelector('#_tgAccessKey').value;
        });
    }
}
class InfoMessageBot extends AbstractInfoMessageBot
{
    buttonRender(chain_buttons_id)
    {
        for (let i=0; i < document.querySelectorAll('#inputChainButtonGroupContainer').length; i++)
        {
            document.querySelectorAll('#inputChainButtonGroupContainer')[i].style.display = 'none';
        }
        for (var i=0; i < bot.messages_chain.length; i++)
        {
            if (bot.messages_chain[i].id === `${chain_index}`)
            {
                for (let x=0; x < bot.messages_chain[i].buttons.length; x++)
                {
                    document
                        .querySelector(`.button-${bot.messages_chain[i].buttons[x].id}`)
                        .style
                        .display = 'block';
                }
            }
        }
    }
    render(chain_id)
    {
        chain_index = chain_id;
        document.getElementById('botInfo').style.display = 'none';
        document.getElementById('chainInfo').style.display = 'block';
        // Выборка данных из bot.messages_chain
        let chain = new InputChainInfo();
        chain.getChain(chain_id);
        // Элемент активный
        add_active(chain_id);
        // Рендер клавиатуры
        this.buttonRender(chain_id);
    }
}


const info = new InfoBot();
document.getElementById('bot').addEventListener('click', function (event){
    info.render();
    chain_index = null;
});

const message = new InfoMessageBot();
document.getElementById(start_uuid).addEventListener('click', function (event){
    message.render(`action-${idx}`);
});

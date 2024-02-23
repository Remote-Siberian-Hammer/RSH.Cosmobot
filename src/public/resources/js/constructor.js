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
    messages_chain: [{id: 0, text: '', buttons: [], next_step: null}]
};
function GENERATE_UUID()
{
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(
        /[xy]/g,
        function(c) {
            var r = Math.random() * 16 | 0;
            return c == 'x' ? r : (r & 0x3 | 0x8).toString(16);
        });
}
let chain_index = null;
let addBotStrategy = function(startElement, button_uuid=null)
{
    const index = document.querySelectorAll('.bot').length;
    const idx = `bot_strategy_${index}`;
    // Создание данных реакции
    bot.messages_chain.push({id: index, text: '', buttons: [], next_step: null});

    document.getElementById('bot_strategy').insertAdjacentHTML(
        'beforeend',
         `<div id="${idx}" class="bot bot-dialog card p-3">
                <div class="bot-header">
                  <p class="text-center">
                    <strong>Сообщение</strong>
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
                        aria-expanded="false">
                      Реакция
                    </button>
                    <ul class="dropdown-menu w-100">
                      <li>
                        <button type="button" 
                            class="dropdown-item" 
                            onclick="addBotStrategy('${idx}')">Сообщение</button>
                        <button type="button" 
                            class="dropdown-item" 
                            onclick="addBotCondition()">Условие</button>
                      </li>
                    </ul>
                  </div>
                </div>
                <div id="botButtonList${chain_index + 1}" class="bot-footer" style="display: none"></div>
              </div>`
    );

    let i=0;
    while (i < bot.messages_chain.length)
    {
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
        message.render(dom_id.split('_')[2]);
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
                        oninput="setChainButtonText('${uuid}')">
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
    bot.messages_chain[chain_index].buttons.push({
        id: uuid,
        type: 'repty',
        text: '',
        url: '',
        next_step: null
    });

    let el = document.getElementById(`botButtonList${chain_index}`);
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
    for (let i=0; i < bot.messages_chain[chain_index].buttons.length; i++)
    {
        if (bot.messages_chain[chain_index].buttons[i].id === uuid)
        {
            data = bot.messages_chain[chain_index].buttons[i];
        }
    }
    return data;
}
let setChainButtonText = function (uuid)
{
    let button = getButtonCollection(uuid);
    button.text = document.getElementById('inputChainButtonText').value;
    for (let i=0; i < document.querySelectorAll(`#botButtonTextElement${chain_index}`).length; i++)
    {
        document.querySelectorAll(`#botButtonTextElement${chain_index}`)[i].innerText = bot.messages_chain[chain_index].buttons[i].text;
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

function setTextChain() { bot.messages_chain[chain_index].text = document.getElementById('inputChainText').value; }

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
        for (let i=0; i < bot.messages_chain[chain_index].buttons.length; i++)
        {
            document.querySelector(`.button-${bot.messages_chain[chain_index].buttons[i].id}`).style.display = 'block';
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
        // Выделить активным элемент
        for (let i =0; i < document.querySelectorAll('.bot').length; i++)
        {
            document.querySelectorAll('.bot')[i].classList.remove('bot-active');
        }
        document.querySelector(`#bot_strategy_${chain_id}`).classList.add('bot-active');
        // Рендер клавиатуры
        this.buttonRender(chain_id);
    }
}


const info = new InfoBot();
document.getElementById('bot').addEventListener('click', function (event){
    info.render();
    for (let i =0; i < document.querySelectorAll('.bot').length; i++)
    {
        document.querySelectorAll('.bot')[i].classList.remove('bot-active');
    }
    chain_index = null;
});

const message = new InfoMessageBot();
document.getElementById('bot_strategy_0').addEventListener('click', function (event){
    message.render(0);
});

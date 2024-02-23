class ButtonGenerateService:
    keyboard_reply_template: dict
    keyboard_inline_template: dict
    buttons: list

    def __init__(self, keyboard_template: dict, buttons: list):
        self.keyboard_reply_template = keyboard_template
        self.keyboard_inline_template = keyboard_template
        self.buttons = buttons

    def getButton(self) -> int:
        return len(self.buttons)

    def generateButton(self) -> None:
        if self.getButton() > 0:
            for button in self.buttons:
                match button["type"]:
                    case "reply":
                        self.keyboard_reply_template["keyboard"].append([{"text": button["text"]}])
                    case "inline":
                        self.keyboard_inline_template["keyboard"].append([{"text": button["text"], "callback_data": button["next_step"]}])

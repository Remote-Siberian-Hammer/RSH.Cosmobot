from dataclasses import dataclass
from typing import List


@dataclass
class Button:
    button_id: int
    type: str
    text: str
    url: str
    next_step: int

    def __init__(self, button_id: int, button_type: str, text: str, url: str, next_step: int):
        self.button_id = button_id
        self.type = button_type
        self.text = text
        self.url = url
        self.next_step = next_step


@dataclass
class Message:
    chat_id: int
    text: str
    buttons: List[Button]
    next_step: int

    def __init__(self, chat_id: int, text: str, buttons: List[Button], next_step: int):
        self.chat_id: int = chat_id
        self.text = text
        self.buttons = buttons
        self.next_step = next_step

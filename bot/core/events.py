from enum import Enum
from dataclasses import dataclass
from uuid import uuid4, UUID


class EventType(Enum):
    USER_MESSAGE = 1
    CHAT_MESSAGE = 2
    ADD_CHAT = 3
    REMOVE_CHAT = 4


@dataclass
class EventMessage:
    id: UUID
    message_id: int
    chat_id: int or None
    user_id: int or None
    username: str or None
    text: str
    attachments: list

    def __init__(self,
                 id: UUID,
                 message_id: int,
                 chat_id: int or None,
                 user_id: int or None,
                 username: str or None,
                 text: str,
                 attachments: list):
        super().__init__()
        self.id = id
        self.message_id = message_id
        self.chat_id = chat_id
        self.user_id = user_id
        self.username = username
        self.text = text
        self.attachments = attachments

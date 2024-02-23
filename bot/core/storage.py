from dataclasses import dataclass
from uuid import UUID


@dataclass
class UserDialogStepIdentity:
    id: UUID or None
    chat_id: int
    next_step: int

    def __init__(self, id: UUID or None, chat_id: int, next_step: int):
        self.id = id
        self.chat_id = chat_id
        self.next_step = next_step

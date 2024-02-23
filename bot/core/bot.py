from dataclasses import dataclass
from enum import Enum


class Platform(Enum):
    VK = 0
    TG = 1


@dataclass
class Bot:
    name: str
    platform: Platform
    access_token: str

    def __init__(self, name: str, platform: Platform, access_token: str):
        self.name = name
        self.platform = platform
        self.access_token = access_token

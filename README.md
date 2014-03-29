# Symfony Streamed Response

## Installation

Download this repo to your src Directory

Add to your AppKernel

    new Tg\DemoStreamBundle\TgDemoStreamBundle(),

And Update your routing File

    tg_demo_stream_annotation:
        resource: "@TgDemoStreamBundle/Controller"
        type: annotation

just open /streamDemo
import Viewer from "viewerjs";
import "viewerjs/dist/viewer.css";

export function MakeViewer(ctx) {
    window.viewer = ctx;
    if (window.viewer !== null && window.viewer !== undefined) {
        const v = new Viewer(document.getElementById(window.viewer), {
            inline: false,
            fullscreen: true,
            button: false,
            toolbar: false,
            tooltip: false,
        });
        v.show();
    }
}

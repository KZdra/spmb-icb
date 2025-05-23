import "./bootstrap";
import "./datatable";
import { apiService } from "./apiservice";
import { MakeChart } from "./chart";
import { MakeViewer } from "./imgViewer.js";
import * as SwalHelper from "./swalHelper.js";
import Viewer from "viewerjs";
window.MakeChart = MakeChart;
window.apiService = apiService;
window.SwalHelper = SwalHelper;
window.MakeViewer = MakeViewer;

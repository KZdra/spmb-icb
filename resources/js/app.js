import "./bootstrap";
import "./datatable";
import { apiService } from "./apiservice";
import { MakeChart } from "./chart";
import * as SwalHelper from "./swalHelper.js";
window.MakeChart = MakeChart;
window.apiService = apiService;
window.SwalHelper = SwalHelper;

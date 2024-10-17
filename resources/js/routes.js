import JobComponent from "./components/JobComponent";
import Organization from "./pages/Organization";
import JobCategory from "./pages/JobCategory";
import JobTitle from "./pages/JobTitle";
import JobDistrict from "./pages/JobDistrict";
import JobSalary from "./pages/JobSalary";

const routes = [
    {
        path: "/",
        component: JobComponent
    },
    {
        path: "/jobs-by-organization",
        component: Organization
    },
    {
        path: "/jobs-by-title",
        component: JobTitle
    },
    {
        path: "/jobs-by-category",
        component: JobCategory
    }
];
export default routes;

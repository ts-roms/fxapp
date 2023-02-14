import { httpApi } from "./http.api"
import { BasicTableData, Pagination } from "./table.api";


export interface CreateEmployeeRequest {
  salutation: string;
  firstName: string;
  middleName: string;
  lastName: string;
  gender: string;
  dob: string;
  contactNumber: string;
  emailAddress: string;
  street: string;
  city: string;
  state: string;
  province: string;
  country: string;
  postalCode: string;
  joiningDate: string;
  branch: string;
  loanOfficer: string;
  salaryRange: string;
  description: string;
}

export const getEmployees = (
  pagination: Pagination,
  pageSize: number
): Promise<BasicTableData> => {
  return httpApi.get('api/v1/employee/list')
    .then(({ data }) => data)
    .catch((e) => e);
}

export const create = (employeeDate: CreateEmployeeRequest): Promise<undefined> => {
  return httpApi.post<undefined>('api/v1/employee/create', { ...employeeDate })
    .then(({ data }) => data);
}
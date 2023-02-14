import { create, CreateEmployeeRequest } from "@app/api/employee.api";
import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";


export interface EmployeeSlice {

}

const initialState: EmployeeSlice = {

}

export const doCreate = createAsyncThunk( 
  'employee/doCreate',
  async (createPayload: CreateEmployeeRequest) => 
  create(createPayload) 
)


const employeeSlice = createSlice({
  name: 'employee',
  initialState,
  reducers: {},
  extraReducers: (builder) => {
    builder.addCase(doCreate.fulfilled, (state, action) => {
    })
  }
});

export default employeeSlice.reducer;
import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// no lazy loading for auth pages to avoid flickering
const AuthLayout = React.lazy(
  () => import('@app/components/layouts/AuthLayout/AuthLayout'),
);
import LoginPage from '@app/pages/LoginPage';
import SignUpPage from '@app/pages/SignUpPage';
import ForgotPasswordPage from '@app/pages/ForgotPasswordPage';
import SecurityCodePage from '@app/pages/SecurityCodePage';
import NewPasswordPage from '@app/pages/NewPasswordPage';
import LockPage from '@app/pages/LockPage';

import MainLayout from '@app/components/layouts/main/MainLayout/MainLayout';
import RequireAuth from '@app/routes/router/RequireAuth';
import { withLoading } from '@app/hocs/withLoading.hoc';
import DashboardPage from '@app/pages/DashboardPages/DashboardPage';
import TransactionPage from '@app/pages/TransactionPage';
import CollectionPage from '@app/pages/CollectionPage';

const NewsFeedPage = React.lazy(() => import('@app/pages/NewsFeedPage'));
const KanbanPage = React.lazy(() => import('@app/pages/KanbanPage'));
const EmployeePage = React.lazy(() => import('@app/pages/EmployeePage'));
const Logout = React.lazy(() => import('./Logout'));

// System Configuration
const BranchesPage = React.lazy(() => import('@app/pages/BranchesPage'));
const UsersPage = React.lazy(() => import('@app/pages/UsersPage'));

export const DASHBOARD_PATH = '/';

const Dashboard = withLoading(DashboardPage);
const NewsFeed = withLoading(NewsFeedPage);
const Kanban = withLoading(KanbanPage);

const Transactions = withLoading(TransactionPage);
const Collections = withLoading(CollectionPage);

// System Configuration
const Employee = withLoading(EmployeePage);
const Branches = withLoading(BranchesPage);
const Users = withLoading(UsersPage);

const AuthLayoutFallback = withLoading(AuthLayout);
const LogoutFallback = withLoading(Logout);

export const AppRouter: React.FC = () => {
  const protectedLayout = (
    <RequireAuth>
      <MainLayout />
    </RequireAuth>
  );

  return (
    <BrowserRouter>
      <Routes>
        <Route path={DASHBOARD_PATH} element={protectedLayout}>
          <Route index path={DASHBOARD_PATH} element={<Dashboard />} />
          <Route path="transactions" element={<Transactions />} />
          <Route path="collections" element={<Collections />} />
          <Route path="funds" element={<Transactions />} />
          <Route path="expenses" element={<Transactions />} />
          <Route path="other-income" element={<Transactions />} />
          <Route path="big-brother" element={<Transactions />} />
          <Route path="reports" element={<Transactions />} />

          <Route path="application">
            <Route path="employees" element={<Employee />} />
            <Route path="feed" element={<NewsFeed />} />
            <Route path="kanban" element={<Kanban />} />
            <Route path="expenses" element={<Kanban />} />
            <Route path="other-income" element={<Kanban />} />
            <Route path="custom-fields" element={<Kanban />} />
          </Route>
          <Route path="system">
            <Route path="users" element={<Users />} />
            <Route path="branches" element={<Branches />} />
          </Route>
          <Route path="audit-trail" element={<Transactions />} />
        </Route>

        <Route path="/auth" element={<AuthLayoutFallback />}>
          <Route path="login" element={<LoginPage />} />
          <Route path="sign-up" element={<SignUpPage />} />
          <Route
            path="lock"
            element={
              <RequireAuth>
                <LockPage />
              </RequireAuth>
            }
          />
          <Route path="forgot-password" element={<ForgotPasswordPage />} />
          <Route path="security-code" element={<SecurityCodePage />} />
          <Route path="new-password" element={<NewPasswordPage />} />
        </Route>
        <Route path="/logout" element={<LogoutFallback />} />
      </Routes>
    </BrowserRouter>
  );
};

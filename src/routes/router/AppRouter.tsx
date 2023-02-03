import React from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

// no lazy loading for auth pages to avoid flickering
const AuthLayout = React.lazy(() => import('@app/components/layouts/AuthLayout/AuthLayout'));
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

const NewsFeedPage = React.lazy(() => import('@app/pages/NewsFeedPage'));
const KanbanPage = React.lazy(() => import('@app/pages/KanbanPage'));
const Logout = React.lazy(() => import('./Logout'));

export const DASHBOARD_PATH = '/';

const Dashboard = withLoading(DashboardPage);
const NewsFeed = withLoading(NewsFeedPage);
const Kanban = withLoading(KanbanPage);

const Transactions = withLoading(TransactionPage);

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
          <Route path="collections" element={<Transactions />} />
          <Route path="funds" element={<Transactions />} />
          <Route path="expenses" element={<Transactions />} />
          <Route path="other-income" element={<Transactions />} />
          <Route path="big-brother" element={<Transactions />} />
          <Route path="reports" element={<Transactions />} />

          <Route path="configuration">
            <Route path="feed" element={<NewsFeed />} />
            <Route path="kanban" element={<Kanban />} />
            <Route path="expenses" element={<Kanban />} />
            <Route path="other-income" element={<Kanban />} />
            <Route path="custom-fields" element={<Kanban />} />
            <Route path="users" element={<Kanban />} />
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

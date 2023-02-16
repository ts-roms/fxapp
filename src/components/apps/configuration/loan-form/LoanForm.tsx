import React, { useState } from 'react';
import { PlusOutlined } from '@ant-design/icons';
import { Button } from 'antd';
import * as S from './LoanForm.styles';
import { useTranslation } from 'react-i18next';
import { LoanFormTable } from '@app/components/tables/Configuration/LoanForm/LoanFormTable';
import LoanFormModal from '@app/components/modals/modal/LoanFormModal';

export const LoanForm: React.FC = () => {
  const { t } = useTranslation();
  const [open, setOpen] = useState(false);

  return (
    <S.MainWrapper>
        <LoanFormModal open={open} setOpen={setOpen} />
      <S.Card
        id="transaction-table"
        title={t('tables.title', { name: 'Loan Form Configuration' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Loan Form' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <LoanFormTable />
      </S.Card>
    </S.MainWrapper>
  );
};

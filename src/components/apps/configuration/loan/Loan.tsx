import React, { useState } from 'react';
import { PlusOutlined } from '@ant-design/icons';
import { Button } from 'antd';
import * as S from './Loan.styles';
import { useTranslation } from 'react-i18next';
import { LoanTable } from '@app/components/tables/Configuration/LoanConfig/LoanTable';
import LoanTypeModal from '@app/components/modals/modal/LoanTypeModal';

export const LoanConfig: React.FC = () => {
  const { t } = useTranslation();
  const [open, setOpen] = useState(false);

  return (
    <S.MainWrapper>
      <LoanTypeModal open={open} setOpen={setOpen} />
      <S.Card
        id="transaction-table"
        title={t('tables.title', { name: 'Loan Configuration' })}
        padding="1.25rem 1.25rem 0"
        extra={
          <S.ActionWrapper>
            <Button
              type="ghost"
              icon={<PlusOutlined />}
              onClick={() => setOpen((open) => !open)}
            >
              {t('actions.new', { name: 'Loan Type' })}
            </Button>
          </S.ActionWrapper>
        }
      >
        <LoanTable />
      </S.Card>
    </S.MainWrapper>
  );
};
